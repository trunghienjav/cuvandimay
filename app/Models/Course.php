<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function getYearCreatedAtAttribute()
    {
        return $this->created_at->format('Y');
    }

    public function students()
    {
        return $this->hasMany(Student::class);//lấy số sv có trong 1 lớp
    }
}
