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
        Schema::create('ordereds', function (Blueprint $table) {
            $table->id();
            $table->integer('orderId');
            $table->integer('productId');
            $table->integer('quantity');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('orderId', 'orderId_fk')
            ->references('id')
            ->on('orders')
            ->onDelete('RESTRICT');

            $table->foreign('productId', 'productId_fk')
            ->references('id')
            ->on('products')
            ->onDelete('RESTRICT');

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
};
