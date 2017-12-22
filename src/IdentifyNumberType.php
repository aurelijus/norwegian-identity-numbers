<?php

namespace Estina\NorwegianIdentityNumber;

use Estina\NorwegianIdentityNumber\Helpers\DateTimeHelper;
use Estina\NorwegianIdentityNumber\Helpers\ReduceDigitsHelper;
use Estina\NorwegianIdentityNumber\Interfaces\ControlSequenceInterface;
use Estina\NorwegianIdentityNumber\Interfaces\IdentificationInterface;

/**
 * @package Estina\NorwegianIdentityNumber
 */
class IdentifyNumberType implements IdentificationInterface
{
    protected $number;
    protected $digits;

    /**
     * @param string $number
     */
    public function __construct(string $number)
    {
        $this->number = trim($number);
        $this->digits = ReduceDigitsHelper::getNumberAsDigitArray($this->number);
    }

    /**
     * @param string $number
     *
     * @return IdentifyNumberType
     */
    public static function factory(string $number): self
    {
        return new static($number);
    }

    /**
     * @return int|null
     */
    public function identify(): ?int
    {
        if (empty($this->number) || !is_numeric($this->number)) {
            return null;
        }

        if ($this->isOrganizationNumber()) {
            return self::ORGANIZATION_NUMBERS;
        }

        if ($this->isBirthNumber()) {
            return self::BIRTH_NUMBERS;
        }

        if ($this->isDNumber()) {
            return self::D_NUMBERS;
        }

        return null;
    }

    /**
     * Organization numbers identify commercial organizations as well as non-profit
     * organizations. Identifying numbers consist of 9 digits. The first digit is
     * either 8 or 9. The last digit is a checksum.
     *
     * @return bool
     */
    public function isOrganizationNumber(): bool
    {
        $firstDigit = $this->digits[0];

        if (9 !== strlen($this->number)) {
            return false;
        }

        if (false === in_array($firstDigit, [8, 9])) {
            return false;
        }

        $reducedChecksum = ReduceDigitsHelper::getReducedChecksumModule(
            ControlSequenceInterface::ORGANIZATION_CONTROL_SEQUENCE,
            $this->digits
        );

        return $reducedChecksum === end($this->digits);
    }

    /**
     * Birth numbers identify individual persons. Every Norwegian citizen is given a unique birth number within
     * a few days after being born. Foreigners may acquire a birth number e.g. when granted citizenship.
     * The numbers consist of 11 digits. The first 6 digits are the birth date (DDMMYY), the next 3 digits
     * constitute an individual number for the particular date, and the last 2 digits are both checksum digits.
     * Ranges within the individual number determine the century. The last digit of the individual number
     * determines gender (even numbers for female individuals and odd numbers for male).
     *
     * @return bool
     */
    public function isBirthNumber(): bool
    {
        if (11 !== strlen($this->number)) {
            return false;
        }

        $structure = new IdentityNumberStruct($this->number);
        $identifiedYear = DateTimeHelper::getIdentityYear($structure->individualNumber, $structure->year);

        if (false === DateTimeHelper::isValidDate($identifiedYear, $structure->month, $structure->day)) {
            return false;
        }

        $firstChecksum = ReduceDigitsHelper::getReducedChecksumModule(
            ControlSequenceInterface::FIRST_BIRTH_CONTROL_SEQUENCE,
            $this->digits
        );

        $secondChecksum = ReduceDigitsHelper::getReducedChecksumModule(
            ControlSequenceInterface::SECOND_BIRTH_CONTROL_SEQUENCE,
            $this->digits
        );

        return $firstChecksum === $this->digits[9] && $secondChecksum === $this->digits[10];
    }

    /**
     * D-numbers is used to identify foreign individuals that don’t qualify for a birth number.
     * The D-number is constructed exactly the same way as birth numbers, but the value 4 is added to the very
     * first digit (e.g. the date 311299 turns into 711299).
     *
     * @return bool
     */
    public function isDNumber(): bool
    {
        if (11 !== strlen($this->number)) {
            return false;
        }

        $structure = new IdentityNumberStruct($this->number);
        $structure->day = $structure->day - 40;
        $identifiedYear = DateTimeHelper::getIdentityYear($structure->individualNumber, $structure->year);

        if (false === DateTimeHelper::isValidDate($identifiedYear, $structure->month, $structure->day)) {
            return false;
        }

        $firstChecksum = ReduceDigitsHelper::getReducedChecksumModule(
            ControlSequenceInterface::FIRST_BIRTH_CONTROL_SEQUENCE,
            $this->digits
        );

        $secondChecksum = ReduceDigitsHelper::getReducedChecksumModule(
            ControlSequenceInterface::SECOND_BIRTH_CONTROL_SEQUENCE,
            $this->digits
        );

        return $firstChecksum === $this->digits[9] && $secondChecksum === $this->digits[10];
    }
}
