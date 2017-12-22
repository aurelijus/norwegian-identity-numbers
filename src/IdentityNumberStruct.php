<?php

namespace Estina\NorwegianIdentityNumber;

use InvalidArgumentException;

/**
 * @package Estina\NorwegianIdentityNumber
 */
class IdentityNumberStruct
{
    /**
     * Pattern which identify the structure of the given national
     * identification number.
     *
     * @const string
     */
    const NATIONAL_IDENTITY_FORMAT = '/((\d{2})(\d{2})(\d{2}))((\d{2}(\d))(\d{2}))/';

    /**
     * @var string
     */
    protected $number;

    /**
     * @var string
     */
    public $birthday;

    /**
     * @var int
     */
    public $day;

    /**
     * @var int
     */
    public $month;

    /**
     * @var int
     */
    public $year;

    /**
     * @var string
     */
    public $personalNumber;

    /**
     * @var string
     */
    public $individualNumber;

    /**
     * @var int
     */
    public $gender;

    /**
     * @var int
     */
    public $controlDigit;

    /**
     * Split given number into groups of structure.
     *
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = trim($number);

        preg_match(static::NATIONAL_IDENTITY_FORMAT, $this->number, $matches);

        if (9 !== count($matches)) {
            throw new InvalidArgumentException('Bad identify number was set!');
        }

        $this->birthday = $matches[1];
        $this->day = (int) $matches[2];
        $this->month = (int) $matches[3];
        $this->year = (int) $matches[4];
        $this->personalNumber = $matches[5];
        $this->individualNumber = $matches[6];
        $this->gender = (int) $matches[7];
        $this->controlDigit = (int) $matches[8];
    }
}
