<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            //Para votantes
            $table->string('identification')->unique();
            //Para Usuarios
            $table->string('username')->nullable()->unique();
            $table->string('name');
            $table->string('email')->unique();
            // $table->string('email');
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role',['voter','admin','supervisor']);
            //Permite votar
            $table->boolean('enabled');
            $table->string('observation')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
