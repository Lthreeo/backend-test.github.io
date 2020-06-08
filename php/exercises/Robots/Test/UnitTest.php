<?php

use Factory\CommandCenter\Blueprints\Robot\Models\Actionman;
use Factory\CommandCenter\Blueprints\Robot\Models\Superman;
use Factory\CommandCenter\Core\Awesome\AwesomeCommandCenter;
use Factory\CommandCenter\Core\DefaultCommandCenter;
use Factory\CommandCenter\Core\ICommandCenter;
use Factory\Factory;
use Factory\IFactory;

$collectiveThinkingFactory = initFactory();
assert($collectiveThinkingFactory instanceof IFactory, 'Must be an instance of IFactory');

// Factory Command center test
$commandCenter = $collectiveThinkingFactory->commandCenter();
assert($commandCenter instanceof DefaultCommandCenter, 'commandCenter must be an instance of DefaultCommandCenter');
assert($commandCenter instanceof ICommandCenter, 'commandCenter must be an instance of ICommandCenter');

// Command center
$commandCenter = new AwesomeCommandCenter();
$commandCenter->boot('Fake factory');
$emptyPipeline = $commandCenter
    ->getPipeline();
assert(is_array($emptyPipeline), 'Must be an array');
assert(empty($emptyPipeline), 'Must be empty');
assert(count($emptyPipeline) === 0, 'Size of pipeline must be equal to 0');

// Add models that doesn't exists
$pipelineWithSkippedModels = $commandCenter
    ->pipe('Car', 'Tesla Model S')
    ->pipe('Human', 'Christopher')
    ->getPipeline();
assert(is_array($pipelineWithSkippedModels), 'Must be an array');
assert(empty($pipelineWithSkippedModels), 'Must be empty');
assert(count($pipelineWithSkippedModels) === 0, 'Size of pipeline must be equal to 0');

// Add models to pipeline
$pipeline = $commandCenter
    ->pipe('Robot', 'Actionman')
    ->pipe('Robot', 'Superman')
    ->getPipeline();
assert(is_array($pipeline), 'Must be an array');
assert(!empty($pipeline), 'Must not be empty');
assert(count($pipeline) === 2, 'Size of pipeline must be equal to 2');

// Superman
$superman = new Superman();
$superman->boot();
$supermanIdentifier = $superman->getIdentifier();
assert(is_string($supermanIdentifier), 'Identifier must be of type string');
assert($superman->powerState(), 'Superman must be boot');

$supermanNewIdentifier = $superman->getIdentifierGeneratorPattern()->generate();
$superman->setIdentifier($supermanNewIdentifier);
assert($supermanNewIdentifier === $superman->getIdentifier(), 'New identifier not saved to superman');
assert($supermanIdentifier !== $supermanNewIdentifier, 'New identifier must be different as possible');

$superman->reset();
assert(empty($superman->getIdentifier()), 'After reset superman must not have an identifier');
assert(!$superman->powerState(), 'After reset superman must not be boot');

// Actionman
$actionman = new Actionman();
$actionman->boot();
$actionmanIdentifier = $actionman->getIdentifier();
assert(is_string($actionmanIdentifier), 'Identifier must be of type string');
assert($actionman->powerState(), 'actionman must be boot');

$actionmanNewIdentifier = $actionman->getIdentifierGeneratorPattern()->generate();
$superman->setIdentifier($supermanNewIdentifier);
assert($supermanNewIdentifier === $superman->getIdentifier(), 'New identifier not saved to actionman');
assert($actionmanIdentifier !== $actionmanNewIdentifier, 'New identifier must be different as possible');

$actionman->reset();
assert(empty($actionman->getIdentifier()), 'After reset actionman must not have an identifier');
assert(!$actionman->powerState(), 'After reset actionman must not be boot');

/**
 * @return Factory
 */
function initFactory()
{
    return new Factory('collective.thinking', new AwesomeCommandCenter());
}