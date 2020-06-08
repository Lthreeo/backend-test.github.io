<?php

namespace Factory\CommandCenter\Core;

use Helpers\RandomGenerator;

/**
 * Interface IBlueprint
 * @package Factory\CommandCenter\Blueprints
 */
interface IBlueprint
{

    /**
     * Boot the manufactured model
     *
     * @return IBlueprint
     */
    public function boot(): IBlueprint;

    /**
     * Reset the manufactured model
     */
    public function reset(): void;

    /**
     * Get power state of manufactured model
     *
     * @return bool
     */
    public function powerState(): bool;

    /**
     * Generate an identifier pattern according to model pattern
     *
     * @return mixed
     */
    public function getIdentifierGeneratorPattern(): RandomGenerator;

    /**
     * Get identifier
     *
     * @return string
     */
    public function getIdentifier(): string;

    /**
     * Set identifier
     *
     * @param string $identifier
     * @return string
     */
    public function setIdentifier(string $identifier): void;

    /**
     * Get model name
     *
     * @return string
     */
    public function getModelName(): string;

    /**
     * Activate main function of the model
     *
     * @return void
     */
    public function activateMainFunction(): void;

}