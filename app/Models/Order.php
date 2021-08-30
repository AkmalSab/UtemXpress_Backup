<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'order';

    public $timestamps = false;

    protected $fillable = [
        'order_id',
        'vehicle_id',
        'id',
        'runner_id',
        'order_pickup_location',
        'order_dropoff_location',
        'receiver_name',
        'receiver_phone',
        'user_review',
        'user_rating',
        'runner_rating',
        'order_fee',
        'favourite',
        'order_remarks',
        'order_status',
        'order_date',
        'order_time',
        'order_type',
        'pickup_location_latitude',
        'pickup_location_longitude',
        'dropoff_location_latitude',
        'dropoff_location_longitude',
    ];
}
