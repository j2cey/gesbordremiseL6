<?php

use App\WorkflowAction;
use Illuminate\Database\Seeder;

class WorkflowActionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $workflowactions = [
            [
                'titre' => "Date Dépôt",
                'description' => "Date Dépôt Agence",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 2,
                'workflow_object_field_id' => 1, // Date Dépôt Agence
                'field_required' => 1,
                'field_required_msg' => "Prière de renseigner la Date Dépôt",
            ],
            [
                'titre' => "Montant Déposé",
                'description' => "Montant Déposé (Agence)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 2,
                'workflow_object_field_id' => 2, // Montant Déposé (Agence)
                'field_required' => 1,
                'field_required_msg' => "Prière de renseigner le Montant Déposé",
            ],
            [
                'titre' => "Scan Bordereau",
                'description' => "Scan Bordereau (Agence)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 2,
                'workflow_object_field_id' => 3, // Scan Bordereau
                'field_required' => 1,
                'field_required_msg' => "Prière de joindre le Scan du Bordereau",
            ],
            [
                'titre' => "Commentaire",
                'description' => "Commentaire (Agence)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 2,
                'workflow_object_field_id' => 4, // Commentaire Agence
                'field_required' => 0,
            ],
            [
                'titre' => "Date Valeur",
                'description' => "Date Valeur (Finances)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 3,
                'workflow_object_field_id' => 5, // Date Valeur
                'field_required' => 1,
                'field_required_msg' => "Prière de renseigner la Date Valeur",
            ],
            [
                'titre' => "Montant Validé",
                'description' => "Montant Validé (Finances)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 3,
                'workflow_object_field_id' => 6, // Montant Validé (Finances)
                'field_required' => 1,
                'field_required_msg' => "Prière de renseigner le Montant Validé",
            ],
            [
                'titre' => "Commentaire",
                'description' => "Commentaire (Finances)",
                'workflow_action_type_id' => 2,
                'workflow_step_id' => 3,
                'workflow_object_field_id' => 7, // Commentaire (Finances)
                'field_required' => 0,
            ],
        ];
        foreach ($workflowactions as $workflowaction) {
            WorkflowAction::create($workflowaction);
        }
    }
}
