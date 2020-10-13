<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class EmailAdress
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $email
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class EmailAddress extends BaseModel
{
    protected $guarded = [];
}
