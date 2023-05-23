<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faults', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->references('id')->on('devices');
            $table->longText('description');
            $table->boolean('is_resolved')->default(false);
            $table->foreignId('tech_id')->nullable()->references('id')->on('users');
            $table->timestamp('time_occurred');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('faults');
    }
};
