<?php

require __DIR__ . '/Luhn.php';

// Test good format & valid number
$validNumber = '4539 1488 0343 6467';
echo "Test good format & valid number [{$validNumber}] " . textResult(Luhn::isValid($validNumber)) . "\n";

// Test good format & invalid number
$invalidNumber = '8273 1232 7352 0569';
echo "Test good format & invalid number [{$invalidNumber}] " . textResult(Luhn::isValid($invalidNumber)) . "\n";

// Test wrong format
$wrongFormat = '4539 1z88 0343 6467';
echo "Test wrong format [{$wrongFormat}] " . textResult(Luhn::isValid($wrongFormat)) . "\n";

function textResult($result)
{
    return $result ? 'OK' : 'NOK';
}