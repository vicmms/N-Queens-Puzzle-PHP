<?php

class QueensPuzzle
{
    private $board = array();
    private $totalQueens;

    public function GET()
    {
        $this->totalQueens = readline('Numero de reinas (min. 8 y max. 27): ');

        // creamos el tablero nxn
        for ($i = 0; $i < $this->totalQueens; $i++) {
            $this->board[$i] = array_fill(0, $this->totalQueens, 0);
        }
        $this->start(0, 0);
        $this->printBoard();
    }

    function start($queenNum, $row)
    {
        for ($col = 0; $col < $this->totalQueens; $col++) {
            if ($this->allowed($row, $col)) {
                // si la celda esta disponible agregamos a la reyna
                $this->board[$row][$col] = 1;

                // si existen reynas antes o despues salimos
                if (($queenNum === $this->totalQueens - 1) || $this->start($queenNum + 1, $row + 1) === true) return true;

                // si no regresamos la posicion a su valor inicial
                $this->board[$row][$col] = 0;
            }
        }

        return false;
    }

    function allowed($x, $y)
    {
        $n = $this->totalQueens;

        // revisamos la disponibilidad para la reyna
        for ($i = 0; $i < $x; $i++) {
            // Revisamos si existe una reyna en la posicion actual
            if ($this->board[$i][$y] === 1) return false;

            // Revisamos las diagonales en ambas direcciones
            $tx = $x - 1 - $i;
            $ty = $y - 1 - $i;
            if (($ty >= 0) && ($this->board[$tx][$ty] === 1)) return false;

            $ty = $y + 1 + $i;
            if (($ty < $n) && ($this->board[$tx][$ty] === 1)) return false;
        }

        return true;
    }

    //Pintamos el tablero 
    function printBoard()
    {
        for ($row = 0; $row < $this->totalQueens; $row++) {
            $div = ' - ';
            for ($col = 0; $col < $this->totalQueens; $col++) {
                $div .= '- - ';
                echo ' | ';

                $cell = $this->board[$row][$col];
                if ($cell === 1) {
                    echo 'Q';
                } else {
                    echo 'x';
                }
            }

            echo " | \n";
            echo $div . "\n";
        }
    }
}

//exec
$Q = new QueensPuzzle();
$Q->GET();
