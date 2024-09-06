<?php

namespace App\Enums;

enum SystemEnum: string {

    use EnumToArray;
    
    case ADMINISTRATIVE = "Administrativo";
    case COMMERCIAL = "Comercial";
}