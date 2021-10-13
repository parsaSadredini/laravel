<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_product', function (Blueprint $table) {
            $table->id();
            $table->string("Name",100);
            $table->string("ImageUrl",250);
            $table->double("Price");
            $table->unsignedBigInteger("OperatorId")->nullable();
            $table->unsignedBigInteger("CategoryId");
            $table->timestamps();
            $table->foreign("CategoryId")->references("id")->on("tbl_category")->onUpdate("cascade")->onDelete('cascade');;
            $table->foreign("OperatorId")->references("id")->on("users")->onUpdate("cascade")->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_product');
    }
}
