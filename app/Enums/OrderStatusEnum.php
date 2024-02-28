<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class OrderStatusEnum extends Enum
{
    const DANG_CHO_XU_LY = 0;
    const DA_DUYET = 1;
    const DA_HUY = 2;

    public static function getArrayView()
    {
        return [
            'Đang chờ xử lý' => self::DANG_CHO_XU_LY,
            'Đã duyệt' => self::DA_DUYET,
            'Đã hủy' => self::DA_HUY
        ];
    }

    public static function getKeyByValue($value)
    {
        return array_search($value, self::getArrayView());
    }
}
