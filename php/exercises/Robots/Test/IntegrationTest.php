<?php

namespace Test;

use Factory\CommandCenter\Core\Awesome\AwesomeCommandCenter;
use Factory\Factory;
use Helpers\RandomGenerator;
use Helpers\TestOutput;

/**
 * @Test
 * Random generator with a pattern like: 2ALPHA-3DIGITS-2ALPHA
 */
$generator = new RandomGenerator();
for ($n = 1; $n < 11; $n++) {
    TestOutput::testCase("{$n}; Random generation",
        $generator
            ->pipe(RandomGenerator::RANDOMIZE_ALPHA, 2)
            ->pipe('-')
            ->pipe(RandomGenerator::RANDOMIZE_DIGIT, 3)
            ->pipe('-')
            ->pipe(RandomGenerator::RANDOMIZE_ALPHA, 2)
            ->generate()
    );
}

/**
 * @Test
 * Build a new factory
 */
TestOutput::testCase('Build new factory', '');
$collectiveThinkingFactory = new Factory('collective.thinking', new AwesomeCommandCenter());
TestOutput::testCase('Factory instance', $collectiveThinkingFactory);

/**
 * @Test
 * Add robots to manufacture pipeline
 */
TestOutput::testCase('Add robots in manufacture pipeline', '');
$pipeline = $collectiveThinkingFactory
    ->commandCenter()
    ->pipe('Robot', 'Actionman')
    ->pipe('Robot', 'Superman')
    ->getPipeline();
TestOutput::testCase('Manufacture pipeline', $pipeline);

// Actionman Robot
const ROBOT_WALKING = 0;
// Superman Robot
const ROBOT_FLYING = 1;

/**
 * @Test
 * Manufacture models from command center pipeline
 */
TestOutput::testCase('Manufacture models from command center pipeline', '');
$collectiveThinkingFactory->manufacture();
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered in control center', $modelsRegistered);

/**
 * @Test
 * Boot Walking robot exercise
 */
TestOutput::testCase('Boot Walking robot exercise from control center', '');
$collectiveThinkingFactory->commandCenter()->bootModelRegistered(ROBOT_WALKING);
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered with booted actionman', $modelsRegistered);

/**
 * @Test
 * Activate Walking robot exercise main skill
 */
TestOutput::testCase('Activate Walking robot exercise main skill', '');
$collectiveThinkingFactory->commandCenter()->activateMainFunctionModelRegistered(ROBOT_WALKING);

/**
 * @Test
 * Reset Walking robot exercise
 */
TestOutput::testCase('Reset Walking robot exercise', '');
$collectiveThinkingFactory->commandCenter()->resetModelRegistered(ROBOT_WALKING);
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered with reset actionman', $modelsRegistered);

/**
 * @Test
 * Boot Flying robot exercise
 */
TestOutput::testCase('Boot Flying robot exercise from control center', '');
$collectiveThinkingFactory->commandCenter()->bootModelRegistered(ROBOT_FLYING);
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered with booted actionman', $modelsRegistered);

/**
 * @Test
 * Activate Flying robot exercise main skill
 */
TestOutput::testCase('Activate Flying robot exercise main skill', '');
$collectiveThinkingFactory->commandCenter()->activateMainFunctionModelRegistered(ROBOT_FLYING);

/**
 * @Test
 * Reset Flying robot exercise
 */
TestOutput::testCase('Reset Flying robot exercise', '');
$collectiveThinkingFactory->commandCenter()->resetModelRegistered(ROBOT_FLYING);
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered with reset superman', $modelsRegistered);

/**
 * @Test
 * Boot robots exercise
 */
TestOutput::testCase('Boot robots exercise from control center', '');
$collectiveThinkingFactory->commandCenter()->bootModelRegistered(ROBOT_FLYING);
$collectiveThinkingFactory->commandCenter()->bootModelRegistered(ROBOT_WALKING);
$collectiveThinkingFactory->commandCenter()->activateMainFunctionModelRegistered(ROBOT_FLYING);
$collectiveThinkingFactory->commandCenter()->activateMainFunctionModelRegistered(ROBOT_WALKING);
$modelsRegistered = $collectiveThinkingFactory->commandCenter()->getModelsRegistered();
TestOutput::testCase('Models registered with booted actionman', $modelsRegistered);