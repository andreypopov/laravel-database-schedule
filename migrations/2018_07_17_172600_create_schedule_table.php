<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Config;

class CreateScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(Config::get('database-schedule.table', 'schedule'), function (Blueprint $table) {
            $table->increments('id');
            $table->string('command');
            $table->text('params')->nullable();
            $table->string('expression');
            $table->boolean('even_in_maintenance_mode')->default(false);
            $table->boolean('without_overlapping')->default(false);
            $table->boolean('on_one_server')->default(false);

            $table->string('webhook_before')->nullable();
            $table->string('webhook_after')->nullable();
            $table->string('email_output')->nullable();
            $table->boolean('sendmail_error')->default(false);

            $table->boolean('status')->default(true);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop(Config::get('database-schedule.table', 'schedule'));
    }
}
