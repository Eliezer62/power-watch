<?php

namespace App\Enum;

enum SensorStatus: string
{
    case Active = "active";
    case Inactive = "inactive";
    case Manutention = "manutention";
    case Instalation = "instalation";
}
