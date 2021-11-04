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
        if(!Schema::hasTable('products'))
         {
            Schema::disableForeignKeyConstraints();


            Schema::create('products', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->unsignedBigInteger('company_id');
                $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');

                $table->string('product_name');
                $table->integer('price');
                $table->integer('stock');
                $table->text('comment');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
            Schema::enableForeignKeyConstraints();
       }
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
