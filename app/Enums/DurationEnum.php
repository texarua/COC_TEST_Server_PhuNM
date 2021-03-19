<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class DurationEnum extends Enum
{
    const MINUTE =   1;
    const HOUR =   2;
    const MONTH =   3;
    const YEAR = 4;
}
