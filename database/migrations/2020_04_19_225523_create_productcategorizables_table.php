<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductcategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productcategorizables', function (Blueprint $table) {
            $table->integer('product_category_id')->unsigned();
            $table->integer('productcategorizable_id')->unsigned();
            $table->string('productcategorizable_type')->index();

            $table->unique(['product_category_id','productcategorizable_id','productcategorizable_type'],'unique_all_together');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('productcategorizables');
    }
}
