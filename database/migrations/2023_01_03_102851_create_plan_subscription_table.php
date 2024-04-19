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
        Schema::create('plan_subscription', function (Blueprint $table) {
            $table->id();
            $table->string('model_type');
            $table->unsignedSmallInteger('model_id');
            $table->foreignId('plan_id')->constrained();
            $table->dateTime('starts_at')->nullable();
            $table->dateTime('ends_at')->nullable();
            $table->dateTime('canceled_at')->nullable();
            $table->enum('status', ['active', 'pending', 'canceled'])->default('pending');
            $table->boolean('is_current')->default(false);
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
        Schema::dropIfExists('plan_subscription');
    }
};
