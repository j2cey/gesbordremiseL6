<?php


namespace App\Traits\BordereauremiseFile;

use App\Bordereauremise;
use App\BordereauremiseLoc;
use App\BordereauremiseModepaie;
use Carbon\Carbon;
use Illuminate\Support\Str;

trait ImportFileTrait
{
    public function import($nb_lines_to_process) {

        $pendingfiles_dir = config('app.bordereauremises_filesscanned');
        $raw_dir = config('app.RAW_FOLDER');
        $file_fullpath = $pendingfiles_dir.'/'.$this->name;

        $csvData = file_get_contents($raw_dir.'/'.$file_fullpath);
        $rows = array_map("str_getcsv", explode("\n", $csvData));

        $rows_processed = 0;
        for ($i = 1; $i < $this->nb_rows; $i++) {
            $row_current = $i + 1;
            $row = $rows[$i];

            $can_process_line = ($row_current > $this->row_last_processed);
            if ($can_process_line) {

                $this->nb_rows_processing += 1;
                $this->save();

                // récuration des paramètres de la ligne
                $row_parsed = $this->getParameters($row);

                if ($row_parsed[0]) {
                    //['date_remise','numero_transaction','localisation_code','localisation_titre','classe_paiement','mode_paiement','montant_total']
                    $localisation = $this->getLocalisation($row_parsed[1]['localisation_code'],$row_parsed[1]['localisation_titre']);
                    $modepaie = $this->getModepaiement($row_parsed[1]['mode_paiement']);
                    // New Bordereauremise
                    Bordereauremise::create([
                        'date_remise' => Carbon::createFromFormat('d/m/Y', $row_parsed[1]['date_remise'])->format('Y-m-d'),//date('Y-m-d',strtotime($row_parsed[1]['date_remise'])),
                        'numero_transaction' => $row_parsed[1]['numero_transaction'],
                        'bordereauremise_loc_id' => $localisation->id,
                        'localisation_titre' => $localisation->titre,
                        'classe_paiement' => utf8_encode($row_parsed[1]['classe_paiement']),
                        'bordereauremise_modepaie_id' => $modepaie->id,
                        'modepaiement_titre' => $modepaie->titre,
                        'montant_total' => $row_parsed[1]['montant_total'],
                        'workflow_currentstep_titre' => "aucun traitement", // On assigne une valeur pour pas faire échouer le check isset
                        'workflow_currentstep_code' => "aucun traitement", // On assigne une valeur pour pas faire échouer le check isset
                    ]);
                    $this->nb_rows_success += 1;
                } else {
                    $this->nb_rows_failed += 1;
                }

                $this->nb_rows_processing -= 1;
                $this->nb_rows_processed += 1;

                $this->save();

                // MAJ du SmscampaingFile
                $this->row_last_processed = $row_current;
                $rows_processed++;
                $this->imported = ($this->nb_rows_processed === $this->nb_rows);
                if ($rows_processed === $nb_lines_to_process) {
                    break;
                }
            }
        }
        $this->nb_try += 1;
        // unmark as processing
        $this->import_processing = 0;
        //$this->imported = ($this->nb_rows_processed >= $this->nb_rows ? 1 : 0);
        $this->save();
    }

    /**
     * @param $titre
     * @return BordereauremiseLoc|null
     */
    private function getLocalisation($code, $titre) {
        $localisation = BordereauremiseLoc::where('code', $code)->first();
        if (! $localisation) {
            $localisation = BordereauremiseLoc::create([
                'code' => $code,
                'titre' => utf8_encode($titre)
            ]);
        }
        return $localisation;
    }

    private function getModepaiement($titre) {
        $modepaie = BordereauremiseModepaie::where('titre', $titre)->first();
        if (! $modepaie) {
            $modepaie = BordereauremiseModepaie::create([
                'code' => Str::slug( (string) Str::orderedUuid() ),
                'titre' => utf8_encode($titre)
            ]);
        }
        return $modepaie;
    }

    private function getParameters($row) {
        // TODO: (1) Tester $row[0]; (2) Faire l'explode si la ligne est un string
        //$row_tab = $row; //explode(',', $row);
        $row_tab = explode(';', $row[0]);
        // DatePaid;TrackingNumber;Location;LocationName;OSS360_PaymentType;BankName;Montant Total
        $row_tab_fields = ['date_remise','numero_transaction','localisation_code','localisation_titre','classe_paiement','mode_paiement','montant_total'];
        $row_tab_values = [];
        $key = 0;
        foreach ($row_tab as $value) {
            $row_tab_values[$row_tab_fields[$key]] = trim($value);
            $key++;
        }

        return [true, $row_tab_values];
    }
}
