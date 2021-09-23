<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    use HasFactory;

    public function translations(){
        return $this->hasMany('App\Models\EmployeeTranslations', 'employee_id', 'id');
    }
}
