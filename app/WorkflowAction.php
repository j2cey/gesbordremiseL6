<?php

namespace App;

use Illuminate\Support\Carbon;

/**
 * Class WorkflowAction
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
 *
 * @property integer|null $workflow_action_type_id
 * @property integer|null $workflow_step_id
 * @property integer|null $workflow_object_field_id
 * @property boolean $field_required
 * @property string|null $field_required_msg
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowAction extends BaseModel
{
    protected $guarded = [];

    public function type() {
        return $this->belongsTo('App\WorkflowActionType', 'workflow_action_type_id');
    }

    public function step() {
        return $this->belongsTo('App\WorkflowStep', 'workflow_step_id');
    }

    public function objectfield() {
        return $this->belongsTo('App\WorkflowObjectField', 'workflow_object_field_id');
    }

    #region Validation Rules

    public static function defaultRules() {
        return [
            'titre' => 'required',
            'type' => 'required',
        ];
    }
    public static function createRules() {
        return array_merge(self::defaultRules(), [

        ]);
    }
    public static function updateRules($model) {
        return array_merge(self::defaultRules(), [

        ]);
    }

    #endregion
}
