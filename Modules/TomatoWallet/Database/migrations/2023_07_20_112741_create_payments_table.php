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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->string('uuid')->index()->unique();

            // maybe user, admin, driver, vendor etc..
            $table->unsignedBigInteger('model_id');
            $table->string('model_table');

            // maybe order, service, subscription etc..
            $table->unsignedBigInteger('order_id');
            $table->string('order_table');

            $table->string('type')->default('payment')->nullable();
            $table->string('payment_method')->default('cash')->index()->nullable();

            $table->unsignedBigInteger('payment_status_id');

            $table->foreign('payment_status_id')
                ->on('payment_status')
                ->references('id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            //Payment Gateway
            $table->string('transaction_vendor')->nullable();
            $table->string('transaction_code')->nullable();

            //Amounts
            $table->double('amount')->unsigned()->default(0);
            $table->string('notes')->nullable();
            $table->string('currency')->default('EGP')->nullable();

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
        Schema::dropIfExists('payments');
    }
};
