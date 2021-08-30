<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicles extends Model
{
    use HasFactory;

    protected $table = 'vehicle';

    public $timestamps = false;

    protected $fillable = [
        'vehicle_type',
        'vehicle_weight_capacity',
        'vehicle_size_capacity',
    ];
}
