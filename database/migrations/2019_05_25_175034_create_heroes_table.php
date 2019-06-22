<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHeroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('heroes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamps();

            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->integer('level');
            $table->integer('race');
            $table->integer('class');
            $table->integer('weapon');
            $table->integer('strength');
            $table->integer('intelligence');
            $table->integer('dexterity');

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('heroes');
    }
}
