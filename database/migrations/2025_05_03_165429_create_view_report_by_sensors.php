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
        CREATE VIEW view_report_by_sensors AS (
            SELECT DISTINCT ON (s.id) s.id, name, model, status, local, r.voltage 
            FROM sensors s 
            LEFT JOIN reports r ON r.sensor_id = s.id 
            GROUP BY s.id, r.voltage, r.created_at
            HAVING NOW() - r.created_at < interval '10 minutes'
        );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('view_report_by_sensors');
    }
};
