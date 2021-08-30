<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    public $table = "staffs";

    protected $fillable = [
        'staff_email',
        'staff_nric',
        'staff_name',
        'staff_designation',
        'staff_faculty',
        'staff_division',
        'staff_status'
    ];
}
