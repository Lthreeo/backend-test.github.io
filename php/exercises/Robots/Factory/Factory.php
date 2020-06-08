<?php

namespace Factory;

use Factory\CommandCenter\Core\ICommandCenter;

/**
 * Class Factory
 * @package Factory
 */
class Factory implements IFactory
{

    /**
     * @var ICommandCenter $commandCenter
     */
    private ICommandCenter $commandCenter;

    /**
     * @var string
     */
    private string $factoryName;

    /**
     * Factory constructor.
     *
     * @param string $factoryName
     * @param ICommandCenter $commandCenter
     */
    public function __construct(string $factoryName, ICommandCenter $commandCenter)
    {
        $this->factoryName = $factoryName;

        /* Define which command center must be used */
        $this->commandCenter = $commandCenter;

        /* Boot command center */
        $this->commandCenter->boot($this->factoryName);
    }

    public function manufacture(): void
    {
        foreach ($this->commandCenter->getPipeline() as $model) {
            $this->commandCenter->registerModelManufactured(new $model());
        }
    }

    public function commandCenter(): ICommandCenter
    {
        return $this->commandCenter;
    }
}