<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCampaignsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('name');
            $table->integer('status_id')->unsigned();
            $table->integer('smsTemplate_id')->unsigned();
            $table->integer('emailTemplate_id')->unsigned();
            $table->integer('interval_day');
            $table->boolean('is_active');
            $table->dateTime('next_send_date');
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('status_id')->references('id')->on('statuses');
            $table->foreign('smsTemplate_id')->references('id')->on('sms_templates');
            $table->foreign('emailTemplate_id')->references('id')->on('email_templates');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('campaigns');
    }
}
