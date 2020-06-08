<?php

namespace Helpers;

/**
 * Class RandomGenerator
 * @package Helpers
 */
class RandomGenerator
{

    const RANDOMIZE_ALPHA = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    const RANDOMIZE_DIGIT = '0123456789';

    /**
     * @var array
     */
    private array $pattern;

    /**
     * RandomGenerator constructor.
     */
    public function __construct()
    {
    }

    /**
     * @param string $randomize
     * @param int|null $iteration
     * @return $this
     */
    public function pipe(string $randomize, int $iteration = null): RandomGenerator
    {
        $length = strlen($randomize);
        $this->pattern[] = ['randomize' => $randomize, 'iteration' => $iteration];
        return $this;
    }

    /**
     * @return string
     */
    public function generate(): string
    {
        $generated = '';
        $sizeOfPattern = count($this->pattern);
        for ($i = 0; $i < $sizeOfPattern; $i++) {
            $pattern = &$this->pattern[$i];
            if (($itr = $pattern['iteration']) !== null) {
                $length = strlen($pattern['randomize']);
                for ($k = 0; $k < $itr; $k++) {
                    $generated .= $pattern['randomize'][rand(0, $length - 1)];
                }
            } else {
                $generated .= $pattern['randomize'];
            }
        }
        $this->pattern = [];
        return $generated;
    }
}