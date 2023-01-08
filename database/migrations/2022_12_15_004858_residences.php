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
        Schema::create('residences', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->string('address');
            $table->string('city');
            $table->string('country');
            $table->string('postalCode');
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId', 'user_id_fk')
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
