<?php


namespace App\Traits\BordereauremiseFile;

use App\BordereauremiseFile;
use Illuminate\Support\Facades\File;

trait ScanFilesTrait
{
    public function scanFiles() {

        //TODO: PB de scan de plus d'1 fichier. Voir de plus près la suppression

        $files_dir = config('app.bordereauremises_files');
        $raw_dir = config('app.RAW_FOLDER');
        $path = $raw_dir.'/'.$files_dir;

        $files = File::allFiles($path);
        $files_count = count($files);

        $file_max_line = 500;

        foreach ($files as $file) {

            $entete_premiere_ligne = true;
            $file_arr = file($file->getPathname());

            if ($entete_premiere_ligne) {
                //remove first line
                $data = array_slice($file_arr, 1);
            } else {
                $data = $file;
            }

            $parts = (array_chunk($data, $file_max_line));
            $parts_count = count($parts);

            if ($parts_count > 0) {

                $i = 1;
                $nb_rows_all = 0;
                $scannedfiles_dir = config('app.bordereauremises_filesscanned');
                foreach ($parts as $line) {
                    $filename = str_replace(['-', ' ', ':'], "", gmdate('Y-m-d h:i:s')) . '_' . $i . '.csv';
                    $filename_full = $raw_dir.'/'.$scannedfiles_dir . '/' . $filename;

                    file_put_contents($filename_full, $line);
                    $i++;

                    $nb_rows_curr = intval(exec("wc -l '" . $filename_full . "'"));
                    BordereauremiseFile::create([
                        'name' => $filename,
                        'nb_rows' => $nb_rows_curr,
                        'report' => json_encode([]),
                    ]);

                    $nb_rows_all += $nb_rows_curr;
                }
            }
            //unlink($file->getPathname());
            File::delete($file->getPathname());
        }

        return $files_count;
    }
}
