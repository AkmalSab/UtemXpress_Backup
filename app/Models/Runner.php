<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Runner extends Model
{
    use HasFactory;

    protected $table = 'runner';
    protected $primaryKey = 'runner_id';
    public $timestamps = true;

    protected $fillable = [
        'runner_id',
        'user_id',
        'runner_license_picture_front',
        'runner_license_picture_back',
    ];

}
