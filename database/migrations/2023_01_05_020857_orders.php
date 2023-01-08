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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('userId');
            $table->integer('residenceId');
            $table->integer('priceTotal');
            $table->boolean('paid')->default(false);
            $table->string('pdf')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('userId', 'user_id_fk')
            ->references('id')
            ->on('users')
            ->onDelete('RESTRICT');

            $table->foreign('residenceId', 'residence_id_fk')
            ->references('id')
            ->on('residences')
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
