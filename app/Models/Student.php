<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $table = 'students';

    protected $fillable = [
        'student_email',
        'student_nric',
        'student_name',
        'student_faculty',
        'student_status',
        'created_at',
        'updated_at',
    ];

}
