<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lists', function (Blueprint $table) {

            $table->increments('id');

            // foreign key -> Users
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            // main columns
            $table->string('name', '100');
            $table->string('description', '512');

            
            $table->softDeletes();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('lists');
    }
}
