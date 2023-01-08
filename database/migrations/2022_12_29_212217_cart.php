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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->integer('productId');
            $table->integer('userId');
            $table->integer('quantity');
            $table->integer('price');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('productId', 'idProduct_fk')
            ->references('id')
            ->on('products')
            ->onDelete('RESTRICT');

            $table->foreign('userId', 'idUser_fk')
            ->references('id')
            ->on('users')
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
