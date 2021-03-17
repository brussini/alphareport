<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSticketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stickets', function (Blueprint $table) {
            $table->increments('id');
            $table->string('operation_num')->nullable();
            $table->string('tech_demandeur_name')->nullable();
            $table->string('tech_interv_name')->nullable();
            $table->string('tech_pilote_name')->nullable();
            $table->string('tech_respo_name')->nullable();
            $table->string('tech_valid_name')->nullable();
            $table->string('tech_cab_name')->nullable();
            $table->dateTime('creation_date')->nullable();
            $table->dateTime('init_state_date')->nullable();
            $table->dateTime('prepa_state_date')->nullable();
            $table->dateTime('reali_state_date')->nullable();
            $table->longText('libell_operation_type')->nullable();
            $table->longText('libell_service_imp')->nullable();
            $table->longText('libell_product_imp')->nullable();
            $table->string('eds_demand_name')->nullable();
            $table->longText('libell_state')->nullable();
            $table->string('eds_pilote_name')->nullable();
            $table->string('eds_interv_name')->nullable();
            $table->longText('description')->nullable();
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->longText('comment')->nullable();
            $table->string('eds_controller_name')->nullable();
            $table->string('eds_respo_name')->nullable();
            $table->string('eds_validate_name')->nullable();
            $table->dateTime('incharge_status_date')->nullable();
            $table->dateTime('valid_status_date')->nullable();
            $table->dateTime('end_status_date')->nullable();
            $table->dateTime('bilan_real_date')->nullable();
            $table->dateTime('close_status_date')->nullable();
            $table->dateTime('on_going_status_date')->nullable();
            $table->dateTime('cancel_status_date')->nullable();
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
        Schema::dropIfExists('stickets');
    }
}
