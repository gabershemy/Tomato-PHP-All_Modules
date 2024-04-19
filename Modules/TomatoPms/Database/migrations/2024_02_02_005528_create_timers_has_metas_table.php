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
        Schema::create('timers_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('timer_id')->constrained('timers')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('linked_id')->nullable()->constrained('issues')->onDelete('cascade');

            $table->string('model')->nullable();
            $table->unsignedBigInteger('model_id')->nullable();

            $table->string('key');
            $table->json('value')->nullable();
            $table->string('type')->default('text')->nullable();
            $table->string('group')->default('general')->nullable();

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
        Schema::dropIfExists('timers_metas');
    }
};
