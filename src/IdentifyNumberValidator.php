<?php

namespace Estina\NorwegianIdentityNumber;

use Estina\NorwegianIdentityNumber\Interfaces\ValidatorInterface;

/**
 * @package Estina\NorwegianIdentityNumber
 */
class IdentifyNumberValidator implements ValidatorInterface
{
    /**
     * {@inheritdoc}
     */
    public static function isValid(string $number): bool
    {
        $identifyNumberType = IdentifyNumberType::factory($number);

        return null !== $identifyNumberType->identify();
    }
}
