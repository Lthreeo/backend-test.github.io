<?php

namespace Factory;

use Factory\CommandCenter\Core\ICommandCenter;

/**
 * Interface IFactory
 * @package Factory
 */
interface IFactory
{

    /**
     * Run manufacture process from command center pipeline
     *
     * @return void
     */
    public function manufacture(): void;

    /**
     * Interact with command center
     *
     * @return ICommandCenter
     */
    public function commandCenter(): ICommandCenter;

}