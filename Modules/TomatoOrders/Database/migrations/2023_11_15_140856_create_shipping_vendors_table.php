<?php

use Illuminate\Support\Facades\DB;
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('shipping_vendors');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Schema::create('shipping_vendors', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('contact_person')->nullable();
            $table->string('delivery_estimation')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();

            $table->boolean('is_activated')->default(0)->nullable();

            $table->json('integration')->nullable();

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
        Schema::dropIfExists('shipping_vendors');
    }
};
