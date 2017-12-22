<?php

namespace Estina\NorwegianIdentityNumber\Interfaces;

/**
 * @package Estina\NorwegianIdentityNumber\Interfaces
 */
Interface ValidatorInterface
{
    /**
     * @param string $number
     *
     * @return bool
     */
    public static function isValid(string $number): bool;
}
