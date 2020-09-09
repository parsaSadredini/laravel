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
            $table->bigInteger("OperatorId")->nullable();
            $table->bigInteger("CategoryId");
            $table->timestamps();

            $table->foreign("CategoryId")->references("id")->on("tbl_category");
            $table->foreign("OperatorId")->references("id")->on("tbl_user");
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
