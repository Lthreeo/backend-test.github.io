<?php

namespace Factory\CommandCenter\Core;

/**
 * Interface ITerminal
 * @package Factory\CommandCenter
 */
interface ITerminal
{

    /**
     * Booting terminal
     *
     * @param string $factoryName
     * @param string $commandCenterVersion
     */
    public function boot(string $factoryName, string $commandCenterVersion): void;

    /**
     * Terminal output
     *
     * @param string $message
     * @return ITerminal
     */
    public function output(string $message): ITerminal;

}