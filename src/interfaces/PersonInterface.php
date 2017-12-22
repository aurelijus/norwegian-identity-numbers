<?php

namespace Estina\IdentityNumber\Interfaces;

use DateTime;

/**
 * @package Estina\IdentityNumber\Interfaces
 */
interface PersonInterface
{
    const FEMALE = 0;
    const MALE = 1;
    const UNSPECIFIED = 2;

    /**
     * Parse gender from identity number.
     * Return 0 when male, 1 when female. By agreement
     * male has odd numbers and women evens.
     *
     * Use constants below to identify gender type.
     *
     * @use {PersonInterface::MALE}
     * @use {PersonInterface::FEMALE}
     *
     * @return int
     */
    public function getGender(): int;

    /**
     * @return DateTime
     */
    public function getBirthday(): DateTime;

    /**
     * Five last digits number from identity number.
     *
     * @return string
     */
    public function getPersonalNumber(): string;

    /**
     * Persons individual number.
     * 3 digits after DDMMYY format digits after overall number.
     *
     * @return string
     */
    public function getIndividualNumber(): string;
}
