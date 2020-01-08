<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterNullableInventario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->string('documento')->nullable()->change();
            $table->string('user_up')->nullable()->change();
            $table->decimal('valor', 14, 2)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inventarios', function (Blueprint $table) {
            $table->string('documento')->nullable(false)->change();
            $table->string('user_up')->nullable(false)->change();
            $table->decimal('valor', 14, 2)->nullable(false)->change();
        });//
    }
}
