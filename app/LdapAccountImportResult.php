<?php

namespace App;

use Illuminate\Support\Carbon;
use PHPUnit\Util\Json;

/**
 * Class LdapAccountImportResult
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property integer $lines_count
 * @property integer $lines_parsed
 * @property integer $lines_parse_success
 * @property integer $lines_parse_fail
 *
 * @property Json $report
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LdapAccountImportResult extends BaseModel
{
    protected $guarded = [];
    protected $table = 'ldap_account_import_results';
}
