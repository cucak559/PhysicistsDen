<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAplicantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aplicants', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->timestamps();

        });

        Schema::create('aplicant_group', function (Blueprint $table) {
            $table->integer('aplicant_id');
            $table->integer('group_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::dropIfExists('aplicants');
      Schema::dropIfExists('aplicant_group');
    }
}
