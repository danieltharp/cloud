<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ExtendItemProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->string('make_model')->nullable();
            $table->string('serial_number')->nullable();
            $table->date('date_purchased')->nullable();
            $table->string('where_purchased')->nullable();
            $table->unsignedInteger('purchase_price')->nullable();
            $table->unsignedInteger('estimated_value')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->dropColumn([
                'make_model',
                'serial_number',
                'date_purchased',
                'where_purchased',
                'purchase_price',
                'estimated_value'
           ]);
        });
    }
}
