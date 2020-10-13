<?php

namespace App;

use App\Traits\Workflow\WorkflowExecTrait;
use Illuminate\Support\Carbon;

/**
 * Class Workflow
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
 * @property string|null $model_type
 *
 * @property integer|null $user_id
 * @property integer|null $workflow_object_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class Workflow extends BaseModel
{
    use WorkflowExecTrait;

    protected $guarded = [];

    #region Eloquent Relationships

    public function steps() {
        return $this->hasMany('App\WorkflowStep')->orderBy('posi');
    }

    public function object() {
        return $this->belongsTo('App\WorkflowObject','workflow_object_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    #endregion

    #region Validation Rules

    public static function defaultRules() {
        return [
            'titre' => 'required',
            'object' => 'required',
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
