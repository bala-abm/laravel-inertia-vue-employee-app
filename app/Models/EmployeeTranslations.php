<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeTranslations extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id',
                    'language_code',
                    'about_employee',
                    'street_address',
                    'employee_name'];
}
