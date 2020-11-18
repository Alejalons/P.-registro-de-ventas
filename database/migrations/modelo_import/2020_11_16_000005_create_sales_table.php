<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSalesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'sales';

    /**
     * Run the migrations.
     * @table sales
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('nameClient');
            $table->string('address');
            $table->string('contact', 45);
            $table->string('rut', 45);
            $table->string('mail');
            $table->string('paymentMethod');
            $table->string('status');
            $table->integer('price');
            $table->integer('dispatchPrice');
            $table->integer('users_id')->unsigned();

            $table->index(["users_id"], 'fk_sales_users1_idx');


            $table->foreign('users_id', 'fk_sales_users1_idx')
                ->references('id')->on('users')
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
