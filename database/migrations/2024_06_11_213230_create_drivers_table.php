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
        Schema::create('drivers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->double('run_price', 2)->nullable();
            $table->string('type_price')->default('cash')->comment('cash, percentage');
            $table->string('pix')->nullable();
            $table->string('car_brand')->nullable();
            $table->boolean('online')->default(0);
            $table->boolean('in_run')->default(0);
            $table->integer('likes')->nullable();
            $table->integer('dislikes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
