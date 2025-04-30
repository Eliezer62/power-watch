<?php

use App\Enum\SensorStatus;
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
        Schema::create('sensors', function (Blueprint $table) {
            $table->uuid("id")->primary("pk_sensors");
            $table->string("name")->unique('uc_sensors_name');
            $table->string("model")->nullable();
            $table->enum("status", [
                "active", "inactive", "maintenance", "installation"
            ])->default("active");
            $table->string("local");
            $table->text("notes")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sensors');
    }
};
