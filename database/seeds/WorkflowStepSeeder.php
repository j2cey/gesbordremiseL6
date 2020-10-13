<?php

use App\WorkflowStep;
use Illuminate\Database\Seeder;

class WorkflowStepSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workflowsteps = [
            [
                'titre' => "Traitement Terminé",
                'code' => "0",
                'description' => "Etape marquant la fin de tout Workflow",
                'posi' => 0,
            ],
            [
                'titre' => "Traitement Agence",
                'code' => "step_0",
                'description' => "Traitements niveau Agence",
                'posi' => 0,
                'workflow_id' => 1,
                'role_id' => 3
            ],
            [
                'titre' => "Traitement Finances",
                'code' => "step_1",
                'description' => "Traitements niveau Finances",
                'posi' => 1,
                'workflow_id' => 1,
                'role_id' => 4
            ],
        ];
        foreach ($workflowsteps as $workflowstep) {
            WorkflowStep::create($workflowstep);
        }
    }
}
