<?php

namespace App\Helpers;

use Illuminate\Support\Carbon;

class FormataCalendario
{
    public static function nomeDoMes($data)
    {
        $carbon = new Carbon(null, 'America/Sao_Paulo','pt_BR');

        $pegarData = $carbon->parse($data); //pega a data-hora

        $resultado = ucfirst($pegarData->translatedFormat('F')); //coloca primeira letra Maicuscula, transforma data para nome do mês completo.

        return $resultado;
    }
}
