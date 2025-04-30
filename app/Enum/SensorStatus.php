<?php

namespace App\Enum;

enum SensorStatus: string
{
    case Active = "active";
    case Inactive = "inactive";
    case Maintenance = "maintenance";
    case Installation = "installation";
}
