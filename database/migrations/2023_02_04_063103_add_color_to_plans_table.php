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
        if (! Schema::hasColumn('plans', 'color')) {
            Schema::table('plans', function (Blueprint $table) {
                $table->string('color', 10)->nullable();
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        if (Schema::hasColumn('plans', 'color')) {
            Schema::table('plans', function (Blueprint $table) {
                $table->dropColumn('color');
            });
        }
    }
};
