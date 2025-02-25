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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid("id")->primary("pk_reports");
            $table->timestamps('timestamp');
            $table->decimal("voltage", 10, 3);
            $table->uuid("sensor_id")->index();
            $table->timestamps();

            $table->foreign('sensor_id', 'fk_reports_sensors')
                ->references('id')->on('sensors');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
