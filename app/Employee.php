<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = [
        "id",
        "nome",
        "cognome",
    ];

    public function attendances()
    {
        return $this->hasMany('App\Attendance');
    }
}
