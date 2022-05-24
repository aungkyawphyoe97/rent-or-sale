<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BuildingType extends Enum
{
    const HOUSE =   0;
    const APARTMENT =   1;
    const BUILDING = 2;
}
