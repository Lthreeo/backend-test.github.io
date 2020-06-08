<?php

namespace Factory\CommandCenter\Core;

/**
 * Class Terminal
 * @package Factory\CommandCenter
 */
abstract class DefaultTerminal implements ITerminal
{

    /**
     * @var string
     */
    private string $psd;

    /**
     * @var string
     */
    private string $version = 'default';

    public function boot(string $factoryName, string $commandCenterVersion): void
    {
        $this->setTerminalPsd($factoryName, $commandCenterVersion);
        $this->output("Boot command center {$commandCenterVersion}...")
            ->output('Ready to execute new manufacture process, waiting instructions');
    }

    private function setTerminalPsd(string $factoryName, string $commandCenterVersion)
    {
        $this->psd = "[{$factoryName}][command.center.{$commandCenterVersion}][term.{$this->version}]: ";
    }

    public function output(string $message): ITerminal
    {
        echo "{$this->psd}", $message, "\n";
        return $this;
    }

}