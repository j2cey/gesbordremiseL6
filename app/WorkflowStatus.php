<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class WorkflowStatus
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
 * @property string $code
 *
 * @property integer|null $workflow_action_type_id
 * @property integer|null $workflow_step_id
 * @property integer|null $workflow_object_field_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowStatus extends BaseModel
{
    protected $guarded = [];

    public function scopeCoded($query, $code) {
        return $query
            ->where('code', $code)
            ;
    }
}
