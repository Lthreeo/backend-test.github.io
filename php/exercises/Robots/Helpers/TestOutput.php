<?php

namespace Helpers;

/**
 * Class TestOutput
 * @package Helpers
 */
class TestOutput
{

    /**
     * @param string $message
     * @param $result
     * @param $wanted
     */
    public static function testCase(string $message, $result, $wanted = null): void
    {
        echo "\nTest case: {$message}\n", "Result:\n", (is_object($result) || is_array($result) ? print_r($result, true) : $result), "\n";
    }
}