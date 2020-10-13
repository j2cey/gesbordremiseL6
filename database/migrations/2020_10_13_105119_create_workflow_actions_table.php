<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowActionsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'workflow_actions';
    public $table_comment = 'action de workflow';

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

            $table->string('titre')->comment('intitule de l action');
            $table->string('description')->nullable()->comment('description de l action');

            $table->unsignedBigInteger('workflow_action_type_id')->nullable()->comment('référence du type d action');
            $table->foreign('workflow_action_type_id')->references('id')->on('workflow_action_types')->onDelete('set null');

            $table->unsignedBigInteger('workflow_step_id')->nullable()->comment('référence de l étape de workflow parent');
            $table->foreign('workflow_step_id')->references('id')->on('workflow_steps')->onDelete('set null');

            $table->unsignedBigInteger('workflow_object_field_id')->nullable()->comment('référence du champs d objet');
            $table->foreign('workflow_object_field_id')->references('id')->on('workflow_object_fields')->onDelete('set null');

            $table->boolean('field_required')->default(false)->comment('determine si le champs est requis');
            $table->string('field_required_msg')->nullable()->comment('message d erreur si le champs est requis');
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
            $table->dropForeign(['workflow_step_id']);
            $table->dropForeign(['workflow_action_type_id']);
            $table->dropForeign(['workflow_object_field_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
