<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Services extends Model
{
    use HasFactory;

    protected $table = 'additional_services';

    public $timestamps = false;

    protected $fillable = [
        'vehicle_type',
        'service_name',
        'service_fee',
    ];
}
