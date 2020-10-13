<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowExecStepsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'workflow_exec_steps';
    public $table_comment = 'Instance d exécution d une étape de workflow';

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

            $table->unsignedBigInteger('workflow_exec_id')->nullable()->comment('référence de l instance d exécution de workflow');
            $table->foreign('workflow_exec_id')->references('id')->on('workflow_execs')->onDelete('set null');

            $table->unsignedBigInteger('workflow_step_id')->nullable()->comment('référence de l etape de workflow');
            $table->foreign('workflow_step_id')->references('id')->on('workflow_steps')->onDelete('set null');

            $table->unsignedBigInteger('user_id')->nullable()->comment('référence du statut de workflow');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');

            $table->unsignedBigInteger('workflow_status_id')->nullable()->comment('référence de l utilisateur');
            $table->foreign('workflow_status_id')->references('id')->on('workflow_statuses')->onDelete('set null');

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
            $table->dropForeign(['workflow_exec_id']);
            $table->dropForeign(['workflow_step_id']);
            $table->dropForeign(['workflow_status_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
