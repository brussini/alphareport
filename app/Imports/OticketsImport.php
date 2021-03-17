<?php

namespace App\Imports;

use App\Oticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;

class OticketsImport implements ToCollection, WithMultipleSheets, WithHeadingRow
{

    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'Liste de tickets' => new OticketsImport()
        ];
    }
    public function collection(Collection $rows)
    {
        
          foreach($rows as $row)
          { 
            Oticket::updateOrcreate([
                        'ticket_num' => $row['n0_ticket']  //if it exists update else create
                    ], [
                                'status'      => $row['etat'],
                                'priority' => $row['priorite_traitement'],
                                'initiator_eds_name' => $row['nom_court_eds_initiateur'],
                                'description' => $row['description'],
                                'problem_detail' => $row['detail_probleme'],
                                'libelle_succ' => $row['libelle_succinct'],
                                'creation_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_creation_ticket']),
                                'starting_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_debut_ticket']),
                                'recovery_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_retablissement_ticket']),
                                'last_repair_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['derniere_date_reparation']),
                                'closure_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_cloture_ticket']),
                                'initiator_eds_names' => $row['nom_court_eds_initiateur'],
                                'active_eds_name' => $row['nom_court_eds_active'],
                                'ticket_type' => $row['type_ticket'],
                                'ressource_identifier' => $row['123_identifiant_ressource'],
                                'product_identifier_1' => $row['identifiant_1_produit'],
                                'product_identifier_2' => $row['identifiant_2_produit'],
                                'recent_comment'     => $row['commentaire_le_plus_recent'],
                                'technician_incharge'      => $row['technicien_responsable'],
                                'initiator_name' => $row['initiateur_nom_utilisateur'],
                                'activation' => $row['activationsnom_utilisateur_prise_en_charge'],
                                'product_type' => $row['type_produit'],
                                'product_identifier_3' => $row['identifiant_3_produit'],
                                'product_identifier_4' => $row['identifiant_4_produit'],
                                'criticity' => $row['criticite'],
                                'ressource_type' => $row['type_ressource'],
                                'ressource_domain' => $row['domaine_ressource'],
                                'ressource_category' => $row['categorie_ressource'],
                                'product_class' => $row['classe_produit'],
                                'last_actor' => $row['dernier_acteur']
                    ]);
            }   
            
    
    }
}
