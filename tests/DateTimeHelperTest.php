<?php

namespace Estina\NorwegianIdentityNumber\Test;

use Estina\NorwegianIdentityNumber\Helpers\DateTimeHelper;
use PHPUnit\Framework\TestCase;

/**
 * @package Estina\NorwegianIdentityNumber\Test
 */
class DateTimeHelperTest extends TestCase
{
    public function testValidDate()
    {
        $this->assertFalse(DateTimeHelper::isValidDate(1999, 2, 29));
        $this->assertTrue(DateTimeHelper::isValidDate(1996, 2, 29));
    }
}
