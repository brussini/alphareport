<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Oticket extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ticket_num',
        'status',
        'priority',
        'initiator_eds_name',
        'description',
        'problem_detail',
        'libelle_succ',
        'creation_date',
        'starting_date',
        'recovery_date',
        'last_repair_date',
        'closure_date',
        'initiator_eds_names',
        'active_eds_name',
        'ticket_type',
        'ressource_identifier',
        'product_identifier_1',
        'product_identifier_2',
        'recent_comment',
        'technician_incharge',
        'initiator_name',
        'activation',
        'product_type',
        'product_identifier_3',
        'product_identifier_4',
        'criticity',
        'ressource_type',
        'ressource_domain',
        'ressource_category',
        'product_class',
        'last_actor',
        'created_at',
        'updated_at'
    ];
}
