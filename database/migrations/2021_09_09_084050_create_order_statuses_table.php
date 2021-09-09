<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\OrderStatus;

class CreateOrderStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_statuses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('status', 60);
            $table->timestamps();
        });
        
        OrderStatus::create(["status" => 'envoyée']);
        OrderStatus::create(["status" => 'en cours de préparation']);
        OrderStatus::create(["status" => 'prête']);
        OrderStatus::create(["status" => 'terminée']);
        OrderStatus::create(["status" => 'en route']);
        OrderStatus::create(["status" => 'livrée']);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_statuses');
    }
}
