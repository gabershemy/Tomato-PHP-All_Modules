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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();

            $table->foreignId('reporter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');

            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade');
            $table->foreignId('closed_by_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('last_update_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('sprint_id')->nullable()->constrained('sprints')->onDelete('cascade');

            $table->unsignedBigInteger('parent_id')->nullable();

            $table->string('type')->default('task')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->string('priority')->default('normal')->nullable();

            $table->string('summary')->index();
            $table->longText('description')->nullable();
            $table->double('points')->default(0)->nullable();

            $table->string('icon')->nullable();
            $table->string('color')->default('#000')->nullable();

            $table->dateTime('closed_at')->nullable();
            $table->dateTime('last_update_at')->nullable();
            $table->integer('order')->default(0)->nullable();

            $table->boolean('is_closed')->default(0)->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('issues');
    }
};
