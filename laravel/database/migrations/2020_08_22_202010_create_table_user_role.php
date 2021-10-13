<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableUserRole extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_user_role', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("UserId");
            $table->unsignedBigInteger("RoleId");
            $table->foreign("UserId")->references("id")->on("users")->onUpdate("cascade")->onDelete('cascade');
            $table->foreign("RoleId")->references("id")->on("tbl_role")->onUpdate("cascade")->onDelete('cascade');
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
        Schema::dropIfExists('table_user_role');
    }
}
