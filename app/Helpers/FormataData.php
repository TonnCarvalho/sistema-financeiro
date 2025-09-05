<?php

namespace App\Helpers;

use IntlDateFormatter;

class FormataData
{
    //Mostra: hoje, ontem, onteontem, dd/mm/aaaa
    public static function relativoDiaMesAno($data)
    {
        $formataData = new IntlDateFormatter(
            'pt_BR', //local pt_BR
            IntlDateFormatter::RELATIVE_SHORT, //formato que mostra a data
            IntlDateFormatter::NONE, //remove o horario
        );

        $resultado  = $formataData->format($data);

        return $resultado;
    }

    //Mostra: dd/mm/aaaa
    public static function diaMesAno($data)
    {
        $formataData = new IntlDateFormatter(
            'pt_BR', //local pt_br
            IntlDateFormatter::SHORT, //formato dd/mm/aaaa
            IntlDateFormatter::NONE, //remove o horario
        );

        $resultado = $formataData->format($data);

        return $resultado;
    }
}
