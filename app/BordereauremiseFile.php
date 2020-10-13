<?php

namespace App;

use App\Traits\BordereauremiseFile\ImportFileTrait;
use Illuminate\Support\Carbon;
use PHPUnit\Util\Json;

/**
 * Class BordereauremiseFile
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $name
 * @property boolean $imported
 *
 * @property Carbon $importstart_at
 * @property Carbon $importend_at
 *
 * @property integer $nb_rows
 * @property boolean $import_processing
 * @property integer $nb_rows_success
 * @property integer $nb_rows_failed
 * @property integer $nb_rows_processing
 * @property integer $nb_rows_processed
 *
 * @property string $row_last_processed
 * @property integer $nb_try
 * @property Json $report
 *
 * @property Carbon $suspended_at
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BordereauremiseFile extends BaseModel
{
    use ImportFileTrait;

    protected $guarded = [];
}
