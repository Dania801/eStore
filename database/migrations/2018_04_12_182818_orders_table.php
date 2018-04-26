<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('orders', function(Blueprint $table){
        $table->increments('id');
        $table->integer('customer_id')->unsigned();
        $table->foreign('customer_id')->references('id')->on('customers');
        $table->integer('product_id')->unsigned();
        $table->foreign('product_id')->references('id')->on('products');
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
        //
    }
}
