<?php

namespace Estina\IdentityNumber\Interfaces;

/**
 * @package Estina\IdentityNumber\Interfaces
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
