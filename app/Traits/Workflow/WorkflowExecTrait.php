<?php


namespace App\Traits\Workflow;

use App\WorkflowExec;
use App\WorkflowExecAction;
use App\WorkflowStatus;
use App\WorkflowStep;

trait WorkflowExecTrait
{
    public function exec() {
        // On créé une nouvelle exécution du Workflow (WorkflowExec)
        $new_exec = WorkflowExec::create([
            'workflow_id' => $this->id,
            'current_step_id' => $this->getFirstStepId(),
            'model_type' => $this->model_type,
            'model_id' => $this->getLastModelId($this->model_type),
            'report' => json_encode([]),
        ]);
    }

    /**
     * Renvoie l'id de la première étape du workflow
     * @return |null
     */
    private function getFirstStepId() {
        $first_step = WorkflowStep::where('workflow_id', $this->id)
            ->where('posi', 0)
            ->first();
        if ($first_step) {
            return $first_step->id;
        } else {
            return null;
        }
    }

    private function getLastModelId($model_type){
        return $model_type::orderBy('id', 'DESC')->first()->id;
    }
}
