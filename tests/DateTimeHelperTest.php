<?php

namespace Estina\IdentityNumber\Tests;

use Estina\IdentityNumber\Helpers\DateTimeHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class DateTimeHelperTest
 *
 * @package Estina\IdentityNumber\Tests
 */
class DateTimeHelperTest extends TestCase
{
    public function testValidDate()
    {
        $this->assertFalse(DateTimeHelper::isValidDate(1999, 2, 29));
        $this->assertTrue(DateTimeHelper::isValidDate(1996, 2, 29));
    }
}
