<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('order_status_id')->unsigned();
            $table->integer('price')->nullable();
            $table->integer('delivery_fee')->nullable();
            $table->text('hint')->nullable();
            $table->text('comment')->nullable();
            $table->boolean('active')->default(1);
            $table->boolean('paid')->default(0);
            $table->integer('driver_id')->nullable()->unsigned();
            $table->integer('delivery_address_id')->nullable()->unsigned();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null')->onUpdate('set null');
            $table->foreign('delivery_address_id')->references('id')->on('delivery_addresses')->onDelete('set null')->onUpdate('set null');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
