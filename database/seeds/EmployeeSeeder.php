<?php

use Illuminate\Database\Seeder;
use App\Employee;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dipendenti = array();

        $dipendenti[] = array("id" => 1, "nome" => "Mario", "cognome" => "Rossi");
        $dipendenti[] = array("id" => 2, "nome" => "Marco", "cognome" => "Gialli");
        $dipendenti[] = array("id" => 3, "nome" => "Luca", "cognome" => "Verdi");

        foreach ($dipendenti as $dipendente) {
            $new_employee = new Employee();
            $new_employee->fill($dipendente);
            $new_employee->save();
        }
    }
}
