<?php

namespace Estina\IdentityNumber\Test;

use Estina\IdentityNumber\Helpers\DateTimeHelper;
use PHPUnit\Framework\TestCase;

/**
 * @package Estina\IdentityNumber\Test
 */
class DateTimeHelperTest extends TestCase
{
    public function testValidDate()
    {
        $this->assertFalse(DateTimeHelper::isValidDate(1999, 2, 29));
        $this->assertTrue(DateTimeHelper::isValidDate(1996, 2, 29));
    }
}
