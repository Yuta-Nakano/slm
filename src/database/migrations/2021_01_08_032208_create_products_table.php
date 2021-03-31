<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table
                ->bigIncrements('id')
                ->comment('ID');
            $table
                ->string('code')
                ->unique()
                ->comment('商品コード');
            $table
                ->string('name')
                ->comment('商品名');
            $table
                ->text('remarks')
                ->nullable()
                ->comment('備考欄');
            $table
                ->unsignedBigInteger('registrant_user_id')
                ->comment('登録者ID');
            $table
                ->unsignedBigInteger('updated_user_id')
                ->comment('最終更新者ID');
            $table
                ->timestamps();
            $table
                ->softDeletes()
                ->nullable();

            $table
                ->foreign('registrant_user_id')
                ->references('id')
                ->on('users');
            $table
                ->foreign('updated_user_id')
                ->references('id')
                ->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
