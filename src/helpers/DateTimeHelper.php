<?php

namespace Estina\NorwegianIdentityNumber\Helpers;

use DateTime;

/**
 * @package Estina\NorwegianIdentityNumber\Helpers
 */
class DateTimeHelper
{
    const MIN_YEAR = 1854;
    const MAX_YEAR = 2039;
    const CALENDAR = CAL_GREGORIAN;

    /**
     * Calculate year number by individual number and two digits of year.
     *
     * @param int $individualNumber
     * @param int $yearDigits
     *
     * @return int
     */
    public static function getIdentityYear(int $individualNumber, int $yearDigits): int
    {
        if ($individualNumber <= 499) {
            return 1900 + $yearDigits;
        }

        if ($individualNumber <= 749 && $yearDigits >= 54) {
            return 1800 + $yearDigits;
        }

        if ($individualNumber >= 900 && $yearDigits >= 40) {
            return 1900 + $yearDigits;
        }

        if ($yearDigits <= 39) {
            return 2000 + $yearDigits;
        }

        return -1;
    }

    /**
     * Checks the minimum and maximum dates and later days in month are correct.
     *
     * @param int $year
     * @param int $month
     * @param int $day
     *
     * @return bool
     */
    public static function isValidDate(int $year, int $month, int $day): bool
    {
        if ($day < 1 || $day > 31) {
            return false;
        }

        if ($month < 1 || $month > 12) {
            return false;
        }

        $minDateTimeYear = (int) (new DateTime())->setDate(self::MIN_YEAR, 1, 1)
            ->format('Y');
        $maxDateTimeYear = (new DateTime())->setDate(self::MAX_YEAR, 1, 1)
            ->format('Y');

        if ($year < $minDateTimeYear || $year > $maxDateTimeYear) {
            return false;
        }

        return cal_days_in_month(static::CALENDAR, $month, $year) >= $day;
    }
}
