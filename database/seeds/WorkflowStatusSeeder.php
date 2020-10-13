<?php

use App\WorkflowStatus;
use Illuminate\Database\Seeder;

class WorkflowStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statuses = [
            [
                'name' => "Nouveau", 'code' => "1", 'is_default' => 1
            ],
            [
                'name' => "Attente Traitement", 'code' => "2", 'is_default' => 0
            ],
            [
                'name' => "En Cours de Traitement", 'code' => "3", 'is_default' => 0
            ],
            [
                'name' => "Traitement Terminé", 'code' => "4", 'is_default' => 0
            ],
            [
                'name' => "Rejété", 'code' => "5", 'is_default' => 0
            ]
        ];
        foreach ($statuses as $status) {
            WorkflowStatus::create($status);
        }
    }
}
