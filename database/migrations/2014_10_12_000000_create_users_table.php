<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('name')->unique();
            $table->bigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->string('passwd', 16);
            $table->string('password' ,255);
            $table->integer("t");
            $table->bigInteger("u");
            $table->bigInteger("d");
            $table->bigInteger("transfer_enable");
            $table->integer("port")->unique();
            $table->tinyInteger("switch")->default(1);
            $table->tinyInteger("enable")->default(1);
            $table->tinyInteger("type")->default(1);
            $table->integer("last_get_gift_time")->default(0);
            $table->integer("last_rest_pass_time")->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
