<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class RentOrSale extends Enum
{
    const RENT =   0;
    const SALE =   1;
}
