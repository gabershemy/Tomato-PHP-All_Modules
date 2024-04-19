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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->unique();

            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('branch_id')->constrained('branches')->onDelete('cascade');
            $table->foreignId('to_branch_id')->nullable()->constrained('branches')->onDelete('cascade');
            $table->foreignId('order_id')->nullable()->constrained('orders')->onDelete('cascade');

            $table->string('type')->default('in')->nullable();
            $table->string('status')->default('pending')->nullable();
            $table->text('notes')->nullable();

            $table->boolean('is_activated')->default(false)->nullable();
            $table->boolean('is_paid')->default(false)->nullable();
            $table->boolean('is_transaction')->default(false)->nullable();

            //Move Payment
            $table->double('vat')->default(0)->nullable();
            $table->double('discount')->default(0)->nullable();
            $table->double('total')->default(0)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
