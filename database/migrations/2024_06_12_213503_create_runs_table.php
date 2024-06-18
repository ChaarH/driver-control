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
        Schema::create('runs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')->constrained('companies');
            $table->foreignId('driver_id')->constrained('drivers');
            $table->double('price', 2);
            $table->boolean('lost_run')->default(0);
            $table->string('city_from')->nullable();
            $table->string('city_to')->nullable();
            $table->string('district_from')->nullable();
            $table->string('district_to')->nullable();
            $table->string('address_from')->nullable();
            $table->string('address_to')->nullable();
            $table->timestamp('started_at')->default(now());
            $table->timestamp('ended_at')->default(now());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('runs');
    }
};
