<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderService extends Model
{
    use HasFactory;

    protected $table = 'order_service';

    public $timestamps = false;


    protected $fillable = [
        'order_service_id',
        'order_id',
        'service_id',
    ];
}
