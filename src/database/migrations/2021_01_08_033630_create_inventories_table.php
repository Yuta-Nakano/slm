<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
                ->comment('ID');
            $table
                ->unsignedBigInteger('branch_id')
                ->comment('拠点ID');
            $table
                ->unsignedBigInteger('product_id')
                ->comment('商品ID');

            $table
                ->foreign('branch_id')
                ->references('id')
                ->on('branches');
            $table
                ->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
