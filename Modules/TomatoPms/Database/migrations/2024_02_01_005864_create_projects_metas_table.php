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
        Schema::create('projects_metas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('project_id')->constrained('projects')->onDelete('cascade');

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
        Schema::dropIfExists('projects_metas');
    }
};
