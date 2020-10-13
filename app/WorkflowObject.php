<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class WorkflowObject
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $model_type
 * @property string $model_title
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowObject extends BaseModel
{
    protected $guarded = [];

    public function fields() {
        return $this->hasMany('App\WorkflowObjectField');
    }
}
