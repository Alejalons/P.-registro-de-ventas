<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sales_Products';

    /**
     * Run the migrations.
     * @table sales_Products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('sales_id')->unsigned();
            $table->integer('products_id')->unsigned();

            $table->index(["sales_id"], 'fk_sales_Products_sales1_idx');
            $table->index(["products_id"], 'fk_sales_Products_products1_idx');


            $table->foreign('products_id', 'fk_sales_Products_products1_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sales_id', 'fk_sales_Products_sales1_idx')
                ->references('id')->on('sales')
                ->onDelete('no action')
                ->onUpdate('no action');    
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->tableName);
     }
}
