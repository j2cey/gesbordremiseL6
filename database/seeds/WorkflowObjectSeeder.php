<?php

use App\WorkflowObject;
use Illuminate\Database\Seeder;

class WorkflowObjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workflowobjects = [
            [
                'model_type' => "App\Bordereauremise", 'model_title' => "Bordereau Remise"
            ],
        ];
        foreach ($workflowobjects as $workflowobject) {
            WorkflowObject::create($workflowobject);
        }
    }
}
