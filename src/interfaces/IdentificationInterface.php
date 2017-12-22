<?php

namespace Estina\IdentityNumber\Interfaces;

/**
 * @package Estina\IdentityNumber\Interfaces
 */
interface IdentificationInterface
{
    const ORGANIZATION_NUMBERS = 1;
    const BIRTH_NUMBERS = 2;
    const D_NUMBERS = 3;

    /**
     * @return bool
     */
    public function isOrganizationNumber(): bool;

    /**
     * @return bool
     */
    public function isBirthNumber(): bool;

    /**
     * @return bool
     */
    public function isDNumber(): bool;
}
