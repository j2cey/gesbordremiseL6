<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class WorkflowObjectField
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $db_field_name
 * @property string $field_label
 *
 * @property boolean|null $valuetype_string
 * @property boolean|null $valuetype_integer
 * @property boolean|null $valuetype_boolean
 * @property boolean|null $valuetype_datetime
 * @property boolean|null $valuetype_image
 *
 * @property integer|null $workflow_object_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowObjectField extends BaseModel
{
    protected $guarded = [];

    public function object() {
        return $this->belongsTo('App\WorkflowObject', 'workflow_object_id');
    }

    public static function boot(){
        parent::boot();

        // Avant enregistrement
        self::saving(function($model){
            $model->field_label = $model->object->model_title . " | " . $model->field_label;
        });
    }
}
