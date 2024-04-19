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
        Schema::create('refund_items', function (Blueprint $table) {
            $table->id();

            $table->string('type')->default('item')->nullable();

            //Link
            $table->foreignId('refund_id')->constrained('refunds')->onDelete('cascade');

            //Item
            $table->string('item_type')->nullable();
            $table->unsignedBigInteger('item_id')->nullable();

            //Linked
            $table->string('linked_type')->nullable();
            $table->unsignedBigInteger('linked_id')->nullable();

            //Item
            $table->string('item')->nullable();
            $table->string('description')->nullable();
            $table->string('note')->nullable();

            //Prices
            $table->double('qty')->default(1)->unsigned()->nullable();
            $table->double('price')->default(0)->unsigned()->nullable();
            $table->double('discount')->default(0)->unsigned()->nullable();
            $table->double('tax')->default(0)->unsigned()->nullable();
            $table->double('total')->default(0)->unsigned()->nullable();

            $table->json('options')->nullable();

            $table->boolean('is_activated')->default(0)->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refund_items');
    }
};
