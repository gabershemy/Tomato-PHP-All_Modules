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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();

            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('approved_by')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('project_leader_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('default_assignee_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('account_id')->nullable()->constrained('accounts')->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('cascade');

            $table->string('name');
            $table->string('view')->default('kanban')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->string('key')->unique()->index();
            $table->string('url')->nullable();
            $table->longText('description')->nullable();
            $table->longText('body')->nullable();

            $table->string('icon')->nullable();
            $table->string('color')->default('#000')->nullable();
            $table->string('type')->default('project')->nullable();

            $table->string('currency')->default('EGP')->nullable();
            $table->double('rate')->default(0)->nullable();
            $table->string('rate_per')->default('hour')->nullable();
            $table->double('total')->default(0)->nullable();

            $table->dateTime('start_at');
            $table->dateTime('end_at')->nullable();

            $table->boolean('is_activated')->default(1)->nullable();
            $table->boolean('is_started')->default(0)->nullable();
            $table->boolean('is_done')->default(0)->nullable();

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
        Schema::dropIfExists('projects');
    }
};
