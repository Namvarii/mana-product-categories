<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategorizablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categorizables', function(Blueprint $table) {
            $table->integer('category_id')->unsigned();
            $table->integer('categorizable_id')->unsigned();
            $table->string('categorizable_type')->index();

            $table->unique(['category_id','categorizable_id','categorizable_type'],'unique_all_together');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categorizables');
    }
}
