<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('price')->nullable();
            $table->integer('models_id')->unsigned();
            $table->integer('sets_id')->unsigned();

            $table->index(["models_id"], 'fk_products_models1_idx');

            $table->index(["sets_id"], 'fk_products_sets1_idx');


            $table->foreign('models_id', 'fk_products_models1_idx')
                ->references('id')->on('models')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('sets_id', 'fk_products_sets1_idx')
                ->references('id')->on('sets')
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
