<?php

namespace App\Services\Tools;

class CellphoneGeneratorService
{
    public function generate($ddd = null)
    {
        $ddd = $ddd ?: $this->randomDDD();
        $number = $ddd . $this->randomCellphoneNumber();
        return $number;
    }

    private function randomDDD()
    {
        $ddds = [11, 21, 31, 41, 51, 61, 71, 81, 91]; // Exemplos
        return $ddds[array_rand($ddds)];
    }

    private function randomCellphoneNumber()
    {
        $firstDigit = 9;
        $rest = str_pad(strval(rand(0, 99999999)), 8, '0', STR_PAD_LEFT);
        return $firstDigit . $rest;
    }
} 