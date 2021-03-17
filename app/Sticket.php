<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
                 'operation_num',
                 'tech_demandeur_name',
                 'tech_interv_name',
                 'tech_pilote_name',
                 'tech_respo_name',
                 'tech_valid_name',
                 'tech_cab_name',
                 'creation_date',
                 'init_state_date',
                 'prepa_state_date',
                 'reali_state_date',
                 'libell_operation_type',
                 'libell_service_imp',
                 'libell_product_imp',
                 'eds_demand_name',
                 'libell_state',
                 'eds_pilote_name',
                 'eds_interv_name',
                 'description',
                 'start_date',
                 'end_date',
                 'comment',
                 'eds_controller_name',
                 'eds_respo_name',
                 'eds_validate_name',
                 'incharge_status_date',
                 'valid_status_date',
                 'end_status_date',
                 'bilan_real_date',
                 'close_status_date',
                 'on_going_status_date',
                 'cancel_status_date',
                 'created_at',
                 'updated_at'
    ];
}
