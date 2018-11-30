<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupMessageTemplatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_message_templates', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->integer('group_templates_id')->unsigned();
            $table->integer('email_templates_id')->unsigned();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('group_templates_id')->references('id')->on('group_templates');
            $table->foreign('email_templates_id')->references('id')->on('email_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_message_templates');
    }
}
