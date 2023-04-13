<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vaccine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'age',
        'birthdate',
        'vaccine_type',
        'address',
        'dose',
        'date_first',
        'date_second',
        'first_booster',
        'second_booster',
        'first_booster_date',
        'second_booster_date',
        'add_booster_date',
        'add_booster_vaccine',
        'vaccine_image',
        'booster_image',
        'status',
    ];
}
