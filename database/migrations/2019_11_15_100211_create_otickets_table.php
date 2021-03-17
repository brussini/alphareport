<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('otickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ticket_num')->nullable();
            $table->string('status')->nullable();
            $table->string('priority')->nullable();
            $table->string('initiator_eds_name')->nullable();
            $table->longText('description')->nullable();
            $table->longText('problem_detail')->nullable();
            $table->string('libelle_succ')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('starting_date')->nullable();
            $table->dateTime('recovery_date')->nullable();
            $table->dateTime('last_repair_date')->nullable();
            $table->dateTime('closure_date')->nullable();
            $table->string('initiator_eds_names')->nullable();
            $table->string('active_eds_name')->nullable();
            $table->string('ticket_type')->nullable();
            $table->string('ressource_identifier')->nullable();
            $table->string('product_identifier_1')->nullable();
            $table->string('product_identifier_2')->nullable();
            $table->longText('recent_comment')->nullable();
            $table->string('technician_incharge')->nullable();
            $table->string('initiator_name')->nullable();
            $table->string('activation')->nullable();
            $table->string('product_type')->nullable();
            $table->string('product_identifier_3')->nullable();
            $table->longText('product_identifier_4')->nullable();
            $table->longText('criticity')->nullable();
            $table->longText('ressource_type')->nullable();
            $table->string('ressource_domain')->nullable();
            $table->string('ressource_category')->nullable();
            $table->string('product_class')->nullable();
            $table->string('last_actor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('otickets');
    }
}
