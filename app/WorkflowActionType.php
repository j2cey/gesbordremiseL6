<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class WorkflowActionType
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $titre
 * @property string $code
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowActionType extends BaseModel
{
    protected $guarded = [];
}
