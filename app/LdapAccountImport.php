<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class LdapAccountImport
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string|null $objectguid
 * @property string|null $username
 * @property string|null $name
 * @property string|null $email
 * @property string|null $password
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class LdapAccountImport extends BaseModel
{
    protected $guarded = [];
    protected $table = 'ldap_account_imports';
}
