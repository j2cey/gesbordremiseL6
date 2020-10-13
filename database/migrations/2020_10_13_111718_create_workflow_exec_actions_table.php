<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowExecActionsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'workflow_exec_actions';
    public $table_comment = 'Instance des actions effectuées/a effectuer par le workflow';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->baseFields();

            $table->unsignedBigInteger('workflow_exec_step_id')->nullable()->comment('référence de l instance d execution d étape');
            $table->foreign('workflow_exec_step_id')->references('id')->on('workflow_exec_steps')->onDelete('set null');

            $table->unsignedBigInteger('workflow_action_id')->nullable()->comment('référence de l action');
            $table->foreign('workflow_action_id')->references('id')->on('workflow_actions')->onDelete('set null');

            $table->unsignedBigInteger('workflow_status_id')->nullable()->comment('référence du statut');
            $table->foreign('workflow_status_id')->references('id')->on('workflow_statuses')->onDelete('set null');

            $table->string('motif_rejet')->nullable()->comment('motif rejet le cas échéant');
            $table->json('report')->comment('rapport d exécution');
        });
        $this->setTableComment($this->table_name,$this->table_comment);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table($this->table_name, function (Blueprint $table) {
            $table->dropBaseForeigns();
            $table->dropForeign(['workflow_exec_step_id']);
            $table->dropForeign(['workflow_action_id']);
            $table->dropForeign(['workflow_status_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
