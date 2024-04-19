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
        Schema::create('inventory_reports', function (Blueprint $table) {
            $table->id();

            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');

            $table->string('item_type')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();

            $table->double('qty')->default(0)->unsigned()->nullable();

            $table->json('options')->nullable();

            $table->boolean('is_activated')->default(false)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_reports');
    }
};
