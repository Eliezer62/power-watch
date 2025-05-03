<?php

namespace App\Http\Services;
use Illuminate\Support\Facades\DB;

class DashboardService
{
    public function findSensorsNotWorking() {
        return DB::select("SELECT * FROM view_sensors_not_working");
    }

    public function reports() {
        return DB::select("SELECT * FROM view_report_by_sensors");
    }
}
