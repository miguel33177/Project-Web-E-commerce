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
        //
        Schema::create('wishlists', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('productId');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId', 'user_id_fk')
            ->references('id')
            ->on('users')
            ->onDelete('RESTRICT');

            $table->foreign('productId', 'product_id_fk')
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
