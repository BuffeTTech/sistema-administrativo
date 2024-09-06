<?php

namespace App\Enums;


enum ScheduleDay: string {

    use EnumToArray;

    case MONDAY = "segunda-feira";
    case TUESDAY = "terça-feira";
    case WEDNESDAY = "quarta-feira";
    case THURSDAY = "quinta-feira";
    case FRIDAY = "sexta-feira";
    case SATURDAY = "sábado";
    case SUNDAY = "domingo";
}