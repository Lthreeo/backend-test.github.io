<?php

namespace Factory\CommandCenter\Blueprints\Robot;

use Factory\CommandCenter\Core\IBlueprint;
use Helpers\RandomGenerator;

/**
 * Class Robot
 * @package Factory\CommandCenter\Blueprints\Robot
 */
abstract class Robot implements IBlueprint
{

    /**
     * @var string
     */
    protected string $blueprintName = 'Robot';

    /**
     * @var string
     */
    private string $identifier;

    /**
     * @var bool
     */
    private bool $power = false;

    public function boot(): IBlueprint
    {
        $this->power = true;
        $this->identifier = $this->getIdentifierGeneratorPattern()->generate();
        return $this;
    }

    public function getIdentifierGeneratorPattern(): RandomGenerator
    {
        return (new RandomGenerator())
            ->pipe(RandomGenerator::RANDOMIZE_ALPHA, 2)
            ->pipe('-')
            ->pipe(RandomGenerator::RANDOMIZE_DIGIT, 3)
            ->pipe('-')
            ->pipe(RandomGenerator::RANDOMIZE_ALPHA, 2);
    }

    public function reset(): void
    {
        $this->identifier = '';
        $this->power = false;
    }

    public function powerState(): bool
    {
        return $this->power;
    }

    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @return string
     */
    public function getBlueprintName(): string
    {
        return $this->blueprintName;
    }

}