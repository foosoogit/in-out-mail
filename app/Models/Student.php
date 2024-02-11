<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'serial_student',
        'email',
        'name_sei',
        'name_mei',
        'name_sei_kana',
        'name_mei_kana',
        'protector',
        'gender',
        'phone',
        'grade',
        'note',
        'course',
        'elementary',
        'junior_high',
        'high_school',
        'pass_for_protector',
        'note',
    ];
}
