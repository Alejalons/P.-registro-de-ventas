<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoleUserTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $tableName = 'role_user';

    /**
     * Run the migrations.
     * @table role_user
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->tableName, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('user_id')->unsigned();
            $table->integer('roles_id')->unsigned();

            $table->index(["roles_id"], 'fk_role_user_roles1_idx');

            $table->index(["user_id"], 'fk_role_user_user1_idx');


            $table->foreign('user_id', 'fk_role_user_user1_idx')
                ->references('id')->on('users')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('roles_id', 'fk_role_user_roles1_idx')
                ->references('id')->on('roles')
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
