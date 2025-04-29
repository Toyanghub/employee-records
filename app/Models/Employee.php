<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'gender',
        'birthday',
        'monthly_salary',
    ];

    // Optional: If you want to automatically cast the birthday to a Carbon instance
    // protected $dates = ['birthday'];
    

    // Optional: If you want to cast the monthly_salary to decimal type
    protected $casts = [
        'monthly_salary' => 'decimal:2',
        'birthday' => 'date',
    ];
}
