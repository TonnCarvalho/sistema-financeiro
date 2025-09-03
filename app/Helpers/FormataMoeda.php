<?php

namespace App\Helpers;

class FormataMoeda
{
    public static function formataMoeda($valor)
    {
        $fomatarMoeda = number_format(
            $valor,
            2,
            ',',
            '.'
        );

        return $fomatarMoeda;
    }
}