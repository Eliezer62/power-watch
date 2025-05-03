<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW view_sensors_not_working AS (
            SELECT id, name, model, status 
            FROM sensors s 
            WHERE NOT EXISTS (
                SELECT 1 FROM view_report_by_sensors v WHERE v.id = s.id
            )
        );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_sensors_not_working;");
    }
};
