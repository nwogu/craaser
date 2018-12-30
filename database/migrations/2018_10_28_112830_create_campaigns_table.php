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
            $table->integer('smsTemplate_id')->unsigned()->nullable();
            $table->integer('emailTemplate_id')->unsigned()->nullable();
            $table->integer('contact_id')->unsigned()->nullable();
            $table->integer('group_contact_id')->unsigned()->nullable();
            $table->integer('group_template_id')->unsigned()->nullable();
            $table->integer('interval_day')->nullable();
            $table->boolean('is_active')->nullable();
            $table->boolean('is_recurring')->nullable();
            $table->string('send_type')->nullable();
            $table->string('target_type')->nullable();
            $table->dateTime('next_send_date')->nullable();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('cascade');
            $table->foreign('smsTemplate_id')->references('id')->on('sms_templates')->onDelete('cascade');
            $table->foreign('emailTemplate_id')->references('id')->on('email_templates')->onDelete('cascade');
            $table->foreign('contact_id')->references('id')->on('contacts')->onDelete('cascade');
            $table->foreign('group_contact_id')->references('id')->on('group_contacts')->onDelete('cascade');
            $table->foreign('group_template_id')->references('id')->on('group_templates')->onDelete('cascade');
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
