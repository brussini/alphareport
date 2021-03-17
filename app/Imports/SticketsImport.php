<?php

namespace App\Imports;

use App\Sticket;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithConditionalSheets;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;

class SticketsImport implements ToCollection, WithHeadingRow, WithBatchInserts, WithChunkReading, WithMultipleSheets
{
    use WithConditionalSheets;

    public function conditionalSheets(): array
    {
        return [
            'liste de tickets' => new SticketsImport()
        ];
    }
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) 
        {
            Sticket::updateOrcreate([            
            'operation_num'     => $row['n0_operation']
            ],[    
                                'tech_demandeur_name'      => $row['nom_tech_dem'],
                                'tech_interv_name' => $row['nom_tech_interv'],
                                'tech_pilote_name' => $row['nom_tech_pilote'],
                                'tech_respo_name' => $row['nom_tech_resp'],
                                'tech_valid_name' => $row['nom_tech_valid'],
                                'tech_cab_name' => $row['nom_tech_cab'],
                                'creation_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_creation_utc']),
                                'init_state_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_initialise_utc']),
                                'prepa_state_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_prepare_utc']),
                                'reali_state_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_realisation_utc']),
                                'libell_operation_type' => $row['libelle_type_operations'],
                                'libell_service_imp' => $row['libelle_impact_service'],
                                'libell_product_imp' => $row['libelle_impact_produit'],
                                'eds_demand_name' => $row['nom_court_eds_demandeur'],
                                'libell_state' => $row['libelle_etat'],
                                'eds_pilote_name' => $row['nom_court_eds_pilote'],
                                'eds_interv_name' => $row['nom_court_eds_intervenant'],
                                'description'     => $row['description_operation'],
                                'start_date'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_debut']),
                                'end_date'      => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_fin']),
                                'comment' => $row['commentaire_le_plus_recent'],
                                'eds_controller_name' => $row['nom_court_eds_controleur'],
                                'eds_respo_name' => $row['nom_court_eds_responsable'],
                                'eds_validate_name' => $row['nom_court_eds_valideur'],
                                'incharge_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_pris_en_charge_utc']),
                                'valid_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_valide_utc']),
                                'end_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_termine_utc']),
                                'bilan_real_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_bilan_realise_utc']),
                                'close_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_clos_utc']),
                                'on_going_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_en_cours_utc']),
                                'cancel_status_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_etat_annule_utc'])

            
            ]);
        }

    }


    public function batchSize(): int
    {
        return 1000;
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
