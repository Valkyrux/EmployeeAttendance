<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Attendance;
use App\Employee;
use DateInterval;
use DateTime;
use Illuminate\Support\Facades\Date;

class AttendanceController extends Controller
{
    public function getGlobalAttendances()
    {
        $attendances = Attendance::orderBy('dataora')->get();

        $tableArray = array();

        $tmp = array();

        foreach ($attendances as $attendance) {
            $employee = Employee::where('id', $attendance->dipendente_id)->first();
            $name = $employee->nome . " " . $employee->cognome;
            if ($attendance->verso) {
                $tmp[] = [
                    $employee->id,
                    $name,
                    $attendance->dataora,
                ];
            } else if (count($tmp) != 0) {
                $found = null;

                foreach ($tmp as $key => $element) {
                    if ($element[0] == $employee->id) {
                        $found = $key;
                    }
                }

                if ($found !== null) {
                    $tmp[$found][] = $attendance->dataora;
                    $tmp[$found][] = date_diff(date_create($tmp[$found][2]), date_create($attendance->dataora))->format('%H:%I:%S');

                    $elementToPush = [];

                    foreach ($tmp[$found] as $index => $info) {
                        if ($index != 0) {
                            $elementToPush[] = $info;
                        }
                    }

                    $tableArray[] = $elementToPush;
                }
            }
        }

        return response()->json([
            'response' => true,
            'result' => $tableArray,
        ]);
    }

    public function weeklyAttendances()
    {
        $date = new DateTime($_GET['date']);
        $day = $date->format('w');
        $week_start = date('d-m-Y', strtotime($date->format('d-m-Y') . '-' . $day . ' days'));
        $dayArray = [];

        $month = "";

        for ($i = 1; $i < 6; $i++) {
            $choosedMonth =  date('M Y', strtotime($week_start . '+' . $i . ' days'));
            if ($month == "") {
                $month = $choosedMonth;
            } else if (stristr($month, '/') === false && $month !== $choosedMonth) {
                $month = $month . '/' . $choosedMonth;
            }
        }

        $tableArray = [
            'columns' => [
                [
                    "title" => "Nome"
                ],
            ],
            'body' => [],
        ];

        for ($i = 1; $i < 6; $i++) {
            $dayArray[] =  date('Y-m-d', strtotime($week_start . '+' . $i . ' days'));
            $tableArray['columns'][] = ["title" => date('D d', strtotime($week_start . '+' . $i . ' days'))];
        }

        $tableArray['columns'][] = ["title" => "Ore totali"];


        $employees = Employee::orderBy('cognome')->get();

        foreach ($employees as $employee) {
            $tableArrayElement = [];
            $name = $employee->nome . " " . $employee->cognome;
            $tableArrayElement[] = $name;
            $unformattedIntervals = [];
            foreach ($dayArray as $day) {
                $this_day = new DateTime($day);
                $this_day_clone = clone $this_day;

                $attendances = Attendance::orderBy('dataora')->whereDate('dataora', $day)->where('dipendente_id', $employee->id)->get();

                if (!empty($attendances)) {
                    $tmp_date = '';

                    foreach ($attendances as $key => $attendance) {
                        if ($key === 0 && !$attendance->verso) {
                            $this_day->add(date_diff(date_create($attendance->dataora), date_sub(date_create($day), new DateInterval('PT24H'))));
                        } else if ($key === count($attendances) - 1 && $attendance->verso) {
                            $this_day->add(date_diff(date_add(date_create($day), new DateInterval('PT24H')), date_create($attendance->dataora)));
                        } else {
                            if ($attendance->verso) {
                                $tmp_date = $attendance->dataora;
                            } else {
                                $this_day->add(date_diff(date_create($attendance->dataora), date_create($tmp_date)));
                            }
                        }
                    }
                    $working_interval = date_diff($this_day, $this_day_clone);

                    $unformattedIntervals[] = $working_interval;
                    $tableArrayElement[] = $working_interval->format('%H:%I:%S');
                } else {
                    $tableArrayElement[] = 0;
                }
            }
            $a_day = new DateTime();
            $a_day_clone = clone $a_day;

            foreach ($unformattedIntervals as $unformattedInterval) {
                date_add($a_day, $unformattedInterval);
            }
            $totalInterval = $a_day->diff($a_day_clone)->format('%H:%I:%S');
            $tableArrayElement[] = $totalInterval;
            $tableArray["body"][] = $tableArrayElement;
        }

        return response()->json([
            'response' => true,
            'result' => $tableArray,
        ]);
    }
}
