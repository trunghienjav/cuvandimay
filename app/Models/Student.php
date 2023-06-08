<?php

namespace App\Models;

use App\Enums\StudentStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class student extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'gender',
        'birthdate',
        'status',
        'course_id',
    ];

    public function getAgeAttribute()
    {
        return $age = date_diff(date_create($this->birthdate), date_create())->y;
    }

    public function getGenderNameAttribute()
    {
        return ($this->gender === 0) ? 'Female' : 'Male';
    }

    public function getStatusNameAttribute()
    {
        // switch ($this->status) {
        //     case '1':
        //         $statusName = 'Đi học';
        //         break;
        //     case '2':
        //         $statusName = 'Nghỉ học';
        //         break;
        //     case '3':
        //         $statusName = 'Bảo lưu';
        //         break;
        //     default:
        //         # code...
        //         break;
        // }
        // if ($this->status === 1) {
        //     $statusName = 'Đi học';
        // }elseif ($this->status === 2) {
        //     $statusName = 'Nghỉ học';
        // } else {
        //     $statusName = 'Bảo lưu';
        // }
        // return $statusName;
        return StudentStatusEnum::getKeyByValue($this->status);//lấy thèn Enum ra bên control, này anh Long chỉ, nhanh vãi

    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
        //key: relationship, cái này để lấy ra khoá ngoại r in ra control, nhưng chỉ lấy theo mối qh 1-1
        //nghĩa là 1 hs thì chỉ đc học theo 1 lớp (theo mình hiểu là như vậy)
    }
}
