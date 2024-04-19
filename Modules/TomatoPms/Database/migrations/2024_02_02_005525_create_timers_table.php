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
        Schema::create('timers', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->nullable()->constrained('projects')->onDelete('cascade');
            $table->foreignId('issue_id')->nullable()->constrained('issues')->onDelete('cascade');
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade');
            $table->foreignId('employee_id')->constrained('users')->onDelete('cascade');

            $table->string('type')->default('work')->nullable();
            $table->string('status')->default('running')->nullable();
            $table->string('color')->nullable();
            $table->string('icon')->nullable();

            $table->string('description')->nullable();

            //Timing
            $table->datetime('start_at');
            $table->datetime('last_stop_at')->nullable();
            $table->datetime('last_restart_at')->nullable();
            $table->datetime('end_at')->nullable();

            $table->double('total_time')->default(0)->nullable();
            $table->double('total_money')->default(0)->nullable();

            $table->integer('rounds')->default(1)->nullable();

            $table->boolean('is_running')->default(1)->nullable();
            $table->boolean('is_done')->default(0)->nullable();
            $table->boolean('is_billable')->default(0)->nullable();
            $table->boolean('is_paid')->default(0)->nullable();

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
        Schema::dropIfExists('timers');
    }
};
