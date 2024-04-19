<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->id();

            // plans data
            $table->json('name');
            $table->json('description')->nullable();
            $table->integer('order')->default(1);

            // Price
            $table->double('price')->default(0);
            $table->integer('invoice_period')->default(0);
            $table->enum('invoice_interval', ['day', 'week', 'month', 'year'])->default('month');


            // Plan Options
            $table->boolean('is_recurring')->nullable()->default(false);
            $table->boolean('is_active')->nullable()->default(true);
            $table->boolean('is_free')->nullable()->default(false);
            $table->boolean('is_default')->nullable()->default(false);

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
        Schema::dropIfExists('plans');
    }
};
