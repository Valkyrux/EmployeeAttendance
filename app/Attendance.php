<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    public $timestamps = false;

    protected $fillable = [
        "id",
        "dipendente_id",
        "dataora",
        "verso",
    ];

    public function employee()
    {
        return $this->belongsTo('App\Employee');
    }
}
