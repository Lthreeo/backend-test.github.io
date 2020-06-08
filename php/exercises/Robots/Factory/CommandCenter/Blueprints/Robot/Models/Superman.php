<?php

namespace Factory\CommandCenter\Blueprints\Robot\Models;

use Factory\CommandCenter\Blueprints\Robot\Robot;

/**
 * Class RobotSuperman
 * @package Factory\CommandCenter\Blueprints\Robot\Models
 */
class Superman extends Robot
{

    /**
     * @var string
     */
    private string $modelName = 'Actionman';

    /**
     * Actionman constructor.
     */
    public function __construct()
    {
    }

    public function getModelName(): string
    {
        return $this->modelName . ' ' . parent::getBlueprintName();
    }

    public function activateMainFunction(): void
    {
        if ($this->powerState()) {
            $identifier = $this->getIdentifier();
            echo "[$identifier] say: Awesome i'm flying!!\n";
        }
    }

}