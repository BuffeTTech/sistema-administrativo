<?php

namespace App\Enums;


enum HandoutStatus: string {

    use EnumToArray;

    case ACTIVE = "Ativo";
    case UNACTIVE = "Inativo";
    case PENDENT = "Pendente";
}