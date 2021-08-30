<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    use HasFactory;

    protected $table = 'runner';

    public $timestamps = true;

    protected $fillable = [
        'user_id',
        'runner_license_picture_front',
        'runner_license_picture_back',
    ];

}
