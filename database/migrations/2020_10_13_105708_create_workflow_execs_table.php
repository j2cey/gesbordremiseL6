<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowExecsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'workflow_execs';
    public $table_comment = 'Instance d exécution d un workflow';

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

            $table->unsignedBigInteger('workflow_id')->nullable()->comment('référence du workflow');
            $table->foreign('workflow_id')->references('id')->on('workflows')->onDelete('set null');

            $table->unsignedBigInteger('current_step_id')->nullable()->comment('référence de l etape courrante');
            $table->foreign('current_step_id')->references('id')->on('workflow_steps')->onDelete('set null');

            $table->unsignedBigInteger('workflow_status_id')->nullable()->comment('référence du statut de workflow');
            $table->foreign('workflow_status_id')->references('id')->on('workflow_statuses')->onDelete('set null');

            $table->string('model_type')->comment('type du modèle référencé');
            $table->bigInteger('model_id')->comment('référence de l instance du modèle');
            $table->string('motif_rejet')->nullable()->comment('motif rejet le cas échéant');
            $table->json('report')->comment('rapport d exécution');

            $table->unsignedBigInteger('current_step_role_id')->nullable()->comment('référence du role de l etape courrante');
            $table->foreign('current_step_role_id')->references('id')->on('roles')->onDelete('set null');
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
            $table->dropForeign(['workflow_id']);
            $table->dropForeign(['current_step_id']);
            $table->dropForeign(['workflow_status_id']);
            $table->dropForeign(['current_step_role_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
