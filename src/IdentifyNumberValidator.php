<?php

namespace Estina\IdentityNumber;

use Estina\IdentityNumber\Interfaces\ValidatorInterface;

/**
 * @package Estina\IdentityNumber
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
