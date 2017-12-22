<?php

namespace Estina\IdentityNumber\Tests;

use Estina\IdentityNumber\IdentifyNumberType;
use Estina\IdentityNumber\Interfaces\IdentificationInterface;
use PHPUnit\Framework\TestCase;

/**
 * Class IdentityNumberTypeTest
 *
 * @package Estina\IdentityNumber\Tests
 */
class IdentityNumberTypeTest extends TestCase
{
    /**
     * @dataProvider getOrganizationTestCase
     * @test
     *
     * @param string $input
     * @param array  $expected
     */
    public function hasExpectedOrganizationValidity($input, $expected)
    {
        $identifyNumberType = IdentifyNumberType::factory($input);

        $this->assertEquals($expected, $identifyNumberType->identify());
    }

    /**
     * @dataProvider getBirthDataCase
     * @test
     *
     * @param string $input
     * @param array  $expected
     */
    public function hasExpectedBirthValidity($input, $expected)
    {
        $identifyNumberType = IdentifyNumberType::factory($input);

        $this->assertEquals($expected, $identifyNumberType->identify());
    }


    /**
     * @dataProvider getDNumberDataCase
     * @test
     *
     * @param string $input
     * @param array  $expected
     */
    public function hasExpectedDNumberValidity($input, $expected)
    {
        $identifyNumberType = IdentifyNumberType::factory($input);

        $this->assertEquals($expected, $identifyNumberType->identify());
    }

    /**
     * @return array
     */
    public function getOrganizationTestCase()
    {
        return [
            ["", null],
            ["87654321", null], // number too short
            ["9876543210", null], // number too long
            ["9A7654321", null], // not numeric strings
            ["023456789", null], // number bad first digit
            ["123456789", null], // number bad first digit
            ["223456789", null], // number bad first digit
            ["323456789", null], // number bad first digit
            ["423456789", null], // number bad first digit
            ["523456789", null], // number bad first digit
            ["523456789", null], // number bad first digit
            ["623456789", null], // number bad first digit
            ["723456789", null], // number bad first digit
            ["987654320", null], // number bad check digit (checksum)
            ["987654321", null], // number bad check digit (checksum)
            ["987654322", null], // number bad check digit (checksum)
            ["987654323", null], // number bad check digit (checksum)
            ["987654324", null], // number bad check digit (checksum)
            ["987654326", null], // number bad check digit (checksum)
            ["987654327", null], // number bad check digit (checksum)
            ["987654328", null], // number bad check digit (checksum)
            ["987654329", null], // number bad check digit (checksum)
            ["801234569", IdentificationInterface::ORGANIZATION_NUMBERS], // legal number
            ["987654325", IdentificationInterface::ORGANIZATION_NUMBERS], // legal number
        ];
    }

    /**
     * @return array
     */
    public function getBirthDataCase()
    {
        return [
            ["", null],
            ["1234567890", null], // number too short
            ["123456789012", null], // number too long
            ["A2345678901", null], // not numeric strings
            ["01014567845", null], // number bad year and individual number combination
            ["01020398709", null], // number bad first digit
            ["01020398719", null], // number bad first digit
            ["01020398729", null], // number bad first digit
            ["01020398739", null], // number bad first digit
            ["01020398749", null], // number bad first digit
            ["01020398759", null], // number bad first digit
            ["01020398779", null], // number bad first digit
            ["01020398789", null], // number bad first digit
            ["01020398799", null], // number bad first digit
            ["01020398760", null], // number bad check digit (checksum)
            ["01020398761", null], // number bad check digit (checksum)
            ["01020398762", null], // number bad check digit (checksum)
            ["01020398763", null], // number bad check digit (checksum)
            ["01020398764", null], // number bad check digit (checksum)
            ["01020398765", null], // number bad check digit (checksum)
            ["01020398766", null], // number bad check digit (checksum)
            ["01020398768", null], // number bad check digit (checksum)
            ["01020398769", null], // number bad check digit (checksum)
            ["01010101944", IdentificationInterface::BIRTH_NUMBERS], // legal number
            ["01020398767", IdentificationInterface::BIRTH_NUMBERS], // legal number
        ];
    }

    /**
     * @return array
     */
    public function getDNumberDataCase()
    {
        return [
            ["", null],
            ["1234567890", null], // number too short
            ["123456789012", null], // number too long
            ["A2345678901", null], // not numeric strings
            ["40019912345", null], // number bad date
            ["72019912345", null], // number bad date
            ["71049912345", null], // number bad date
            ["69029912345", null], // number bad date
            ["41009912345", null], // number bad date
            ["41139912345", null], // number bad date
            ["41014567845", null], // number bad year and individual number combination
            ["41020398700", null], // number bad first check digit
            ["41020398710", null], // number bad first check digit
            ["41020398720", null], // number bad first check digit
            ["41020398730", null], // number bad first check digit
            ["41020398740", null], // number bad first check digit
            ["41020398760", null], // number bad first check digit
            ["41020398770", null], // number bad first check digit
            ["41020398780", null], // number bad first check digit
            ["41020398790", null], // number bad first check digit
            ["41020398751", null], // number bad second check digit
            ["41020398752", null], // number bad second check digit
            ["41020398753", null], // number bad second check digit
            ["41020398754", null], // number bad second check digit
            ["41020398755", null], // number bad second check digit
            ["41020398756", null], // number bad second check digit
            ["41020398757", null], // number bad second check digit
            ["41020398758", null], // number bad second check digit
            ["41020398759", null], // number bad second check digit
            ["41020398750", IdentificationInterface::D_NUMBERS], // legal number
            ["67047000642", IdentificationInterface::D_NUMBERS], // legal number
            ["42059199212", IdentificationInterface::D_NUMBERS], // legal number
        ];
    }
}
