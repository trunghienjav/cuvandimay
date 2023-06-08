<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class StudentStatusEnum extends Enum
{
    public const DI_HOC = 1;
    public const BO_HOC = 2;
    public const BAO_LUU = 3;

    //enum lưu không có dấu nên phải tạo 1 hàm riêng để lấy ra chữ có dấu như khế lày
    public static function getArrayView() : array
    {
        return [
            'Đi học' => self::DI_HOC,
            'Bỏ học' => self::BO_HOC,
            'Bảo lưu' => self::BAO_LUU,
        ];//hàm khai static thì phải dùng self chứ ko gọi được this, tại vì nếu khai báo biến static
        //thì nó là biến cục bộ của 1 class, muốn dùng phải dùng câu lệnh tênclass.tên_hàm, còn this
        //là tham chiếu biến instance cụ thể, nên ko dùng được (hiểu theo chát gpt)
    }

    public static function getKeyByValue($value) : string
    {
        return array_search($value, self::getArrayView(), true); //buổi 15, key: search by value, anh Long chỉ rễ hiểu vkl
        //hàm này để lấy ra cái enum để in ra bên control
    }
}
