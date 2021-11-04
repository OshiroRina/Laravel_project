<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('sales'))
         {
            Schema::create('sales', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->integer('product_id');
                $table->timestamp('created_at')->nullable();
                $table->timestamp('updated_at')->nullable();
            });
       }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');

       
    }
}
