<?php

namespace Estina\IdentityNumber;

use DateTime;
use Estina\IdentityNumber\Helpers\DateTimeHelper;
use Estina\IdentityNumber\Interfaces\IdentificationInterface;
use Estina\IdentityNumber\Interfaces\PersonInterface;

/**
 * @package Estina\IdentityNumber
 */
class Person implements PersonInterface
{
    const AVAILABLE_IDENTITY_TYPES = [
        IdentificationInterface::BIRTH_NUMBERS,
        IdentificationInterface::D_NUMBERS,
    ];

    /**
     * @var string
     */
    protected $number;

    /**
     * @var IdentityNumberStruct
     */
    protected $structure;

    /**
     * @var int
     */
    protected $identityType;

    /**
     * IdentityNumber constructor.
     *
     * @param string $number
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(string $number)
    {
        $this->number = trim($number);
        $numberType = IdentifyNumberType::factory($this->number);
        $this->identityType = $numberType->identify();

        if (false === in_array($this->identityType, self::AVAILABLE_IDENTITY_TYPES)) {
            throw new \InvalidArgumentException("Invalid identity number. Only Birth or D numbers are acceptable.");
        }

        $this->structure = new IdentityNumberStruct($this->number);
    }

    /**
     * Factory design method to initialize object.
     *
     * @param string $number
     *
     * @return Person
     */
    public static function factory(string $number): self
    {
        return new static($number);
    }

    /**
     * {@inheritdoc}
     */
    public function getBirthday(): DateTime
    {
        $dateTime = new DateTime();

        $yearDigits = DateTimeHelper::getIdentityYear(
            (int) $this->structure->individualNumber,
            $this->structure->year
        );

        return $dateTime->setDate($yearDigits, $this->structure->month, $this->structure->day);
    }

    /**
     * {@inheritdoc}
     */
    public function getPersonalNumber(): string
    {
        return $this->structure->personalNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getIndividualNumber(): string
    {
        return $this->structure->individualNumber;
    }

    /**
     * {@inheritdoc}
     */
    public function getGender(): int
    {
        $genders = [PersonInterface::FEMALE, PersonInterface::MALE];

        return $genders[$this->structure->gender % 2];
    }

    /**
     * @return int
     */
    public function getIdentityType(): int
    {
        return $this->identityType;
    }
}
