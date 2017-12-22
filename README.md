# Norwegian Identity Number (National Id) Validator

> The Norwegian national ID number is an 11-digit personal identifier. Everyone on the Norwegian National Registry has a national ID number.
> Validate Norwegian national identity numbers.

## Features

 - Person identifier to get a gender, personal number, individual number, birth dates
 - Validate identify number as boolean
 - Get identifier what kind number it is

## Requirements

 - PHP >= 7.0

## Installation

```sh
composer require estina/norwegian-identity-numbers
```

## Usage

### Validator

```php
use Estina\IdentityNumber\IdentifyNumberValidator;

$number = '01010101944';
$isValidNumber = IdentifyNumberValidator::isValid($number); // true

// other method to check
$identifyNumberType = IdentifyNumberType::factory($number);
$isValidNumber = null !== $identifyNumberType->identify(); // true
```

### Identify Number Type

```php
use Estina\IdentityNumber;
use Estina\IdentityNumber\Interfaces;

$number = '01010101944';
$identifyNumberType = IdentifyNumberType::factory($number);
// this identify simultenous and return the type for it
$identifyType = $identifyNumberType->identify();
// now $identifyType are one of constants:
// IdentificationInterface::ORGANIZATION_NUMBERS
// IdentificationInterface::BIRTH_NUMBERS
// IdentificationInterface::D_NUMBERS

// or identify by single one
$identifyNumberType->isOrganizationNumber(); // false/true
$identifyNumberType->isBirthNumber(); // false/true
$identifyNumberType->isDNumber(); // false/true
```

### Person

```php
use Estina\IdentityNumber;
use Estina\IdentityNumber\Interfaces;

$person = new Person('01010101944');
$person->getBirthday(); // DateTime
$person->getGender(); // PersonInterface::FEMALE or PersonInterface::MALE
```