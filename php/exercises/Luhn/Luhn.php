<?php
declare(strict_types=1);

/**
 * Class Luhn
 */
class Luhn
{

    /**
     * Check string input according to luhn algorithm
     *
     * @param string $str
     * @return bool
     */
    public static function isValid(string $str): bool
    {
        $str = str_replace(' ', '', $str);
        if(ctype_digit($str)) {
            $sum = 0;
            $digitsCount = strlen($str);
            $parity = $digitsCount % 2;
            for($i = 0; $i < $digitsCount; $i++) {
                $digit = $str[$i];
                if ($i % 2 === $parity) {
                    $digit *= 2;
                }
                if ($digit > 9) {
                    $digit -= 9;
                }
                $sum += $digit;
            }
            return $sum % 10 === 0;
        }
        return false;
    }
}
