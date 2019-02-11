<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProblemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('problems', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->string("coords")->nullable();
          $table->longText('problem_title');
          $table->longText('problem_content')->nullable();
          $table->timestamps();
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
      Schema::dropIfExists('problems');

    }
}
