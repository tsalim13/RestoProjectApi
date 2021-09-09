<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateOrderTypeOrderStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_type_order_status', function (Blueprint $table) {
            $table->integer('order_types_id')->unsigned();
            $table->integer('order_status_id')->unsigned();
            $table->primary(['order_types_id', 'order_status_id']);
            $table->foreign('order_status_id')->references('id')->on('order_statuses')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('order_types_id')->references('id')->on('order_types')->onDelete('cascade')->onUpdate('cascade');
        });

        // emporté 1
        // livraison 2
        DB::table('order_type_order_status')->insert(
            array(
                [
                    'order_types_id' => 1,
                    'order_status_id' => 1,
                ],
                [
                    'order_types_id' => 1,
                    'order_status_id' => 2,
                ],
                [
                    'order_types_id' => 1,
                    'order_status_id' => 3,
                ],
                [
                    'order_types_id' => 1,
                    'order_status_id' => 4,
                ],
                [
                    'order_types_id' => 2,
                    'order_status_id' => 1,
                ],
                [
                    'order_types_id' => 2,
                    'order_status_id' => 2,
                ],
                [
                    'order_types_id' => 2,
                    'order_status_id' => 3,
                ],
                [
                    'order_types_id' => 2,
                    'order_status_id' => 5,
                ],
                [
                    'order_types_id' => 2,
                    'order_status_id' => 6,
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_type_order_status');
    }
}
