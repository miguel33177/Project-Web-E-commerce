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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('sellerId');
            $table->integer('review');
            $table->text('comment');
            $table->timestamps();


            $table->foreign('userId', 'userId_fk')
            ->references('id')
            ->on('users')
            ->onDelete('RESTRICT');

            $table->foreign('sellerId', 'sellerId_fk')
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
