<?php

namespace Factory\CommandCenter\Core;


/**
 * Interface IFactoryCommandCenter
 * @package Factory
 */
interface ICommandCenter
{

    /**
     * Boot system
     *
     * @param string $factoryName
     * @return mixed
     */
    public function boot(string $factoryName): void;

    /**
     * Add blueprint in manufacturing pipe
     *
     * @param string $blueprintIdentifier
     * @param string $modelIdentifier
     * @return ICommandCenter
     */
    public function pipe(string $blueprintIdentifier, string $modelIdentifier): ICommandCenter;

    /**
     * Get blueprints in manufacturing pipeline
     *
     * @return array
     */
    public function getPipeline(): array;

    /**
     * Register model manufactured in control center
     *
     * @param IBlueprint $model
     */
    public function registerModelManufactured(IBlueprint $model): void;

    /**
     * Boot model registered in control center
     *
     * @param int $controlCenterIdentifier
     * @return void
     */
    public function bootModelRegistered(int $controlCenterIdentifier): void;

    /**
     * Reset model registered in control center
     *
     * @param int $controlCenterIdentifier
     * @return void
     */
    public function resetModelRegistered(int $controlCenterIdentifier): void;

    /**
     * Activate main skill of model registered
     *
     * @param int $controlCenterIdentifier
     */
    public function activateMainFunctionModelRegistered(int $controlCenterIdentifier): void;

    /**
     * Get models registered in control center
     *
     * @return array
     */
    public function getModelsRegistered(): array;

    /**
     * @param int $controlCenterIdentifier
     * @return bool
     */
    public function controlCenterIdentifierIsValid(int $controlCenterIdentifier): bool;

}