<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User_Roles extends Model
{
    use HasFactory;

    protected $table = 'user_roles';

    protected $fillable = [
        'role_id',
        'user_id',
        'student_email',
        'staff_email',
        'admin_email',
    ];
}
