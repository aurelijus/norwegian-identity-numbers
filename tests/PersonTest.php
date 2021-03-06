<?php

namespace Estina\NorwegianIdentityNumber\Test;

use Estina\NorwegianIdentityNumber\Interfaces\IdentificationInterface;
use Estina\NorwegianIdentityNumber\Person;
use PHPUnit\Framework\TestCase;

/**
 * @package Estina\NorwegianIdentityNumber\Test
 */
class PersonTest extends TestCase
{
    /**
     * @var Person
     */
    protected $validator;

    protected function setUp()
    {
        $this->validator = new Person('29029600013');
    }

    /**
     * @test
     */
    public function shouldExpectBirthdayDate()
    {
        $this->assertEquals(
            '1996-02-29',
            $this->validator->getBirthday()
                ->format('Y-m-d')
        );
    }

    /**
     * @test
     * @expectedException \InvalidArgumentException
     */
    public function shouldExpectInvalidArgumentException()
    {
        Person::factory('29029900157');
    }

    /**
     * @test
     */
    public function shouldExpectMaleGender()
    {
        $this->assertEquals(Person::FEMALE, $this->validator->getGender());
    }

    /**
     * @test
     */
    public function shouldExpectPersonalNumber()
    {
        $this->assertEquals('00013', $this->validator->getPersonalNumber());
    }

    /**
     * @test
     */
    public function shouldExpectDNumberType()
    {
        $this->assertEquals(IdentificationInterface::D_NUMBERS,
            Person::factory('42059199212')
                ->getIdentityType()
        );
    }
}
