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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->integer('idProduct');
            $table->integer('userId');
            $table->float('rating');
            $table->text('comment');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('idProduct', 'idProduct_fk')
            ->references('id')
            ->on('products')
            ->onDelete('RESTRICT');

            $table->foreign('userId', 'userId_fk')
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
