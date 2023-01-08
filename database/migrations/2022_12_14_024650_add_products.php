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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('nameProduct');
            $table->integer('categoryId');
            $table->float('price');
            $table->string('state');
            $table->text('description');
            $table->integer('quantityStock');
            $table->string('photo', 300);
            $table->integer('views')->default(0);
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId', 'user_id_fk')
            ->references('id')
            ->on('users')
            ->onDelete('RESTRICT');

           $table->foreign('categoryId', 'category_id_fk')
            ->references('id')
            ->on('categories')
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
     
    }
};
