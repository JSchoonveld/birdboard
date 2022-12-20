<?php

namespace App\Enums;

use Spatie\Enum\Enum;

/**
 * @method static self admin()
 * @method static self user()
 * @method static self guest()
 */
final class Role extends Enum
{
    protected static function values(): array
    {
        return [
            'admin' => 1,
            'user' => 2,
            'guest' => 3,
        ];
    }
}
