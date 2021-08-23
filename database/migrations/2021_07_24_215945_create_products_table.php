<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 60);
            $table->double('price', 8, 2)->default(0);
            $table->double('discount_price', 8, 2)->nullable()->default(0);
            $table->text('description')->nullable();
            $table->double('capacity', 9, 2)->nullable()->default(0);
            $table->string('unit', 20)->nullable()->default('');
            $table->boolean('deliverable')->nullable()->default(1);
            $table->boolean('available')->default(1);
            $table->integer('category_id')->unsigned();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
