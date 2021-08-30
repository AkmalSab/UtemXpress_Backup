<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner_Vehicle extends Model
{
    use HasFactory;

    protected $table = 'runner_vehicle';

    protected $fillable = [
        'runner_id',
        'vehicle_type',
        'vehicle_picture',
        'vehicle_number_plate_picture',
        'vehicle_roadtax_picture',
    ];
}
