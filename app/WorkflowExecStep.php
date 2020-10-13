<?php

namespace App;

use Illuminate\Support\Carbon;
use PHPUnit\Util\Json;

/**
 * Class WorkflowExecStep
 * @package App
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property integer|null $workflow_exec_id
 * @property integer|null $workflow_step_id
 *
 * @property Json $report
 * @property integer|null $workflow_status_id
 * @property integer|null $user_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class WorkflowExecStep extends BaseModel
{
    protected $guarded = [];

    #region Eloquent Relationships

    public function exec() {
        return $this->belongsTo('App\WorkflowExec', 'workflow_exec_id');
    }

    public function step() {
        return $this->belongsTo('App\WorkflowStep', 'workflow_step_id');
    }

    public function execstatus() {
        return $this->belongsTo('App\WorkflowStatus', 'workflow_status_id');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }

    #endregion
}
