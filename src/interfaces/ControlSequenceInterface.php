<?php

namespace Estina\IdentityNumber\Interfaces;

/**
 * Interface ControlSequenceInterface
 *
 * @package Estina\IdentityNumber\Interfaces
 */
interface ControlSequenceInterface
{
    const ORGANIZATION_CONTROL_SEQUENCE = [3, 2, 7, 6, 5, 4, 3, 2];
    const FIRST_BIRTH_CONTROL_SEQUENCE = [3, 7, 6, 1, 8, 9, 4, 5, 2];
    const SECOND_BIRTH_CONTROL_SEQUENCE = [5, 4, 3, 2, 7, 6, 5, 4, 3, 2];
}
