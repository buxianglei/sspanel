<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string("name");
            $table->string("model");
            $table->tinyInteger('create');
            $table->tinyInteger('update');
            $table->tinyInteger('retrieve');
            $table->tinyInteger('delete');
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create("permission_role", function (Blueprint $table){
            $table->bigInteger("permission_id");
            $table->bigInteger("role_id");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('permissions');
        Schema::dropIfExists('permission_role');
    }
}
