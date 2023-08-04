<?php

namespace App\Objects\Enums;

enum DocumentTypes: string
{
    case NIT = 'NUMERO DE IDENTIFICACION TRIBUTARIA';
    case TI = 'TARJETA DE IDENTIDAD';

    case CC = 'CEDULA';
    case PAP = 'PASAPORTE';
}
