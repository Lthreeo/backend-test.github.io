<?php

namespace Factory\CommandCenter\Core;


use Factory\CommandCenter\Core\Awesome\AwesomeTerminal;

/**
 * Class FactoryCommandCenter
 * @package Factory
 */
abstract class DefaultCommandCenter implements ICommandCenter
{

    /**
     * @var ITerminal
     */
    private ITerminal $term;

    /**
     * @var string
     */
    private string $version = 'default';

    /**
     * @var string
     */
    private string $blueprintsLocation = '\Factory\CommandCenter\Blueprints';

    /**
     * @var array
     */
    private array $pipeline = [];

    /**
     * @var array
     */
    private array $controlCenter = [];

    /**
     * DefaultCommandCenter constructor.
     */
    public function __construct()
    {
    }

    public function boot(string $factoryName): void
    {
        $this->term = new AwesomeTerminal();
        $this->term->boot($factoryName, $this->version);
    }

    public function pipe(string $blueprintIdentifier, string $modelIdentifier): ICommandCenter
    {
        $modelToManufacture = "$this->blueprintsLocation\\$blueprintIdentifier\\Models\\$modelIdentifier";
        if (class_exists($modelToManufacture)) {
            $this->pipeline[] = $modelToManufacture;
            $this->term
                ->output("Blueprint $blueprintIdentifier $modelIdentifier has been successfully added to manufacture pipeline.");
        } else {
            $this->term
                ->output("Blueprint $modelToManufacture does'nt exist.. Skip instruction..");
        }
        return $this;
    }

    public function getPipeline(): array
    {
        return $this->pipeline;
    }

    public function registerModelManufactured(IBlueprint $model): void
    {
        $this->controlCenter[] = [
            'identifier' => null,
            'model' => $model
        ];
        $this->term
            ->output("{$model->getModelName()} manufactured & ready to boot.");
    }

    public function bootModelRegistered(int $controlCenterIdentifier): void
    {
        if ($this->controlCenterIdentifierIsValid($controlCenterIdentifier)) {
            $model = &$this->controlCenter[$controlCenterIdentifier]['model'];
            $modelIdentifierGenerated = $model
                ->boot()->getIdentifier();

            $identifiers = array_column($this->controlCenter, 'identifier');
            while (in_array($modelIdentifierGenerated, $identifiers)) {
                $modelIdentifierGenerated = $model
                    ->getIdentifierGeneratorPattern()->generate();
            }
            $model->setIdentifier($modelIdentifierGenerated);
            $this->controlCenter[$controlCenterIdentifier]['identifier'] = $modelIdentifierGenerated;

            $this->term
                ->output("Model manufactured on control center identifier has been successfully boot with name: $modelIdentifierGenerated");
        }
    }

    public function controlCenterIdentifierIsValid(int $controlCenterIdentifier): bool
    {
        if (!($isValid = isset($this->controlCenter[$controlCenterIdentifier]))) {
            $this->term
                ->output("Control center identifier $controlCenterIdentifier does'nt exist.. Skip instruction..");
        }
        return $isValid;
    }

    public function activateMainFunctionModelRegistered(int $controlCenterIdentifier): void
    {
        if ($this->controlCenterIdentifierIsValid($controlCenterIdentifier)) {
            $this->controlCenter[$controlCenterIdentifier]['model']->activateMainFunction();
        }
    }

    public function resetModelRegistered(int $controlCenterIdentifier): void
    {
        if ($this->controlCenterIdentifierIsValid($controlCenterIdentifier)) {
            $model = &$this->controlCenter[$controlCenterIdentifier]['model'];

            $this->term
                ->output("{$model->getModelName()} is running reset instruction...");

            $this->controlCenter[$controlCenterIdentifier]['identifier'] = '';
            $model->reset();

            $this->term
                ->output("{$model->getModelName()} has been successfully reset.");
        }
    }

    public function getModelsRegistered(): array
    {
        return $this->controlCenter;
    }

}