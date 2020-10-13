<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkflowObjectFieldsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'workflow_object_fields';
    public $table_comment = 'champs d objet pouvant faire l objet d un workflow';

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

            $table->string('db_field_name')->comment('nom du champs dans la base de données');
            $table->string('field_label')->comment('libele du champs');

            $table->boolean('valuetype_string')->default(false)->comment('determine si la valeur du champs est de type STRING');
            $table->boolean('valuetype_integer')->default(false)->comment('determine si la valeur du champs est de type INTEGER');
            $table->boolean('valuetype_boolean')->default(false)->comment('determine si la valeur du champs est de type BOOLEAN');
            $table->boolean('valuetype_datetime')->default(false)->comment('determine si la valeur du champs est de type DATETIME');
            $table->boolean('valuetype_image')->default(false)->comment('determine si la valeur du champs est de type IMAGE');

            $table->unsignedBigInteger('workflow_object_id')->nullable()->comment('référence de l objet');
            $table->foreign('workflow_object_id')->references('id')->on('workflow_objects')->onDelete('set null');
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
            $table->dropForeign(['workflow_object_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
