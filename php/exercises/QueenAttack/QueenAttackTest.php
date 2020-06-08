<?php

require __DIR__ . '/QueenAttack.php';

$queenAttack = new QueenAttack();

// Test valid coordinates
$i = 1; $j = 2;
try {
    $canPlaceQueen = $queenAttack->placeQueen($i, $j);
    echo "Test valid coordinates [$i, $j] ", textResult($canPlaceQueen), "\n\n";
} catch (InvalidChessboardCoordinatesException $e) {
    echo 'Must not be display - ',  $e, "\n\n";
}

// Test invalid coordinates
$i = 9; $j = 2;
try {
    $canPlaceQueen = $queenAttack->placeQueen($i, $j);
    echo "Must not be display - Test invalid coordinates [$i, $j] ", textResult($canPlaceQueen), "\n\n";
} catch (InvalidChessboardCoordinatesException $e) {
    echo $e, "\n\n";
}

// Test can attack $black queen with coordinates out of chessboard
$canAttack = $queenAttack->canAttack([2, 9], [5, 6]);
echo $canAttack ? 'Checkmate!!' : 'Try again..', "\n\n";

// Test can attack $black queen with diagonal
$canAttack = $queenAttack->canAttack([2, 3], [5, 6]);
echo $canAttack ? 'Checkmate!!' : 'Try again..', "\n\n";

// Test can attack $black queen with same column
$canAttack = $queenAttack->canAttack([2, 3], [2, 6]);
echo $canAttack ? 'Checkmate!!' : 'Try again..', "\n\n";

// Test can attack $black queen with same row
$canAttack = $queenAttack->canAttack([1, 6], [2, 6]);
echo $canAttack ? 'Checkmate!!' : 'Try again..', "\n\n";

// Test can attack $black queen without possibly
$canAttack = $queenAttack->canAttack([1, 4], [2, 6]);
echo $canAttack ? 'Checkmate!!' : 'Try again..', "\n";

/**
 * @param $result
 * @return string
 */
function textResult(bool $result): string
{
    return $result ? 'OK' : 'NOK';
}