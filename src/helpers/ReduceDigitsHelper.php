<?php

namespace Estina\IdentityNumber\Helpers;

use Estina\IdentityNumber\Interfaces\ControlSequenceInterface;

/**
 * Class ReduceDigitsHelper
 *
 * @package Estina\IdentityNumber\Helpers
 */
class ReduceDigitsHelper implements ControlSequenceInterface
{
    /**
     * @param string $number
     *
     * @return array
     */
    public static function getNumberAsDigitArray(string $number): array
    {
        return array_map('intval', str_split($number));
    }

    /**
     * @param array $sequence
     * @param array $digits
     *
     * @return int
     */
    public static function getReducedNumberChecksum(array $sequence, array $digits): int
    {
        $index = 0;
        $checksum = array_reduce(
            $sequence,
            function ($total, $number) use ($digits, &$index) {
                $total += $number * $digits[$index];
                $index++;

                return $total;
            },
            0
        );


        return $checksum;
    }

    /**
     * @param array $sequence
     * @param array $digits
     *
     * @return int
     */
    public static function getReducedChecksumModule(array $sequence, array $digits): int
    {
        $checksum = static::getReducedNumberChecksum($sequence, $digits);
        $result = 11 - ($checksum % 11);

        return $result !== 11 ? $result : 0;
    }
}