<?php
declare(strict_types=1);

require __DIR__ . '/InvalidChessboardCoordinatesException.php';

class QueenAttack
{

    const COORDINATE_I_INDEX = 0;
    const COORDINATE_J_INDEX = 1;

    const CHESSBOARD_ROWS = 8;
    const CHESSBOARD_COLUMNS = 8;

    /**
     * QueenAttack constructor.
     */
    public function __construct()
    {
    }

    /**
     * Can queen be placed on chessboard ?
     *
     * @param int $i
     * @param int $j
     * @return bool
     * @throws InvalidChessboardCoordinatesException
     */
    public function placeQueen(int $i, int $j)
    {
        $iMax = self::CHESSBOARD_COLUMNS-1;
        $jMax = self::CHESSBOARD_ROWS-1;

        if($i > $iMax || $j > $jMax) {
            throw new InvalidChessboardCoordinatesException("QueenAttack::placeQueen(i = $i, j = $j) Chessboard coordinates must be i = [0-$iMax], j = [0-$jMax]");
        }
        return true;
    }

    /**
     * Can queen attack ?
     *
     * @param int[] $white Coordinates of the white Queen
     * @param int[] $black Coordinates of the black Queen
     * @return bool
     * @throws InvalidArgumentException
     */
    public function canAttack(array $white, array $black): bool
    {
        try {
            $this->placeQueen($white[self::COORDINATE_I_INDEX], $white[self::COORDINATE_J_INDEX]);
            $this->placeQueen($black[self::COORDINATE_I_INDEX], $black[self::COORDINATE_J_INDEX]);
            $this->displayChessboard($white, $black);

            // Test column
            if($white[self::COORDINATE_I_INDEX] === $black[self::COORDINATE_I_INDEX]) {
                return true;
            }

            // Test row
            if($white[self::COORDINATE_J_INDEX] === $black[self::COORDINATE_J_INDEX]) {
                return true;
            }

            // Test abs of queens
            if(abs($white[self::COORDINATE_I_INDEX] - $black[self::COORDINATE_I_INDEX])
                === abs($white[self::COORDINATE_J_INDEX] - $black[self::COORDINATE_J_INDEX]))
            {
                return true;
            }
        } catch (InvalidChessboardCoordinatesException $e) {
            echo $e, "\n";
        }

        return false;
    }

    /**
     * Display chessboard according to white & black queens coordinates
     *
     * @param int[] $white Coordinates of the white Queen
     * @param int[] $black Coordinates of the black Queen
     */
    public function displayChessboard(array $white, array $black): void
    {
        $chessboard = '';
        for($j = 0; $j < self::CHESSBOARD_ROWS; $j++) {
            for($i = 0; $i < self::CHESSBOARD_COLUMNS; $i++) {
                if($i === $white[self::COORDINATE_I_INDEX] && $j === $white[self::COORDINATE_J_INDEX]) {
                    $chessboard .= 'W';
                } elseif($i === $black[self::COORDINATE_I_INDEX] && $j === $black[self::COORDINATE_J_INDEX]) {
                    $chessboard .= 'B';
                } else {
                    $chessboard .= '_';
                }
                $chessboard .= '  ';
            }
            $chessboard .= "\n";
        }
        echo $chessboard;
    }

}
