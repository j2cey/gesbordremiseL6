<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartementsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'departements';
    public $table_comment = 'liste des départements';

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

            $table->string('intitule')->comment('intitule du departement');
            $table->string('chemin_complet')->nullable()->comment('chemin complet du departement en tenant compte des parents');
            $table->string('description')->nullable()->comment('description du departement');

            $table->unsignedBigInteger('type_departement_id')->nullable()->comment('référence du type de departement');
            $table->foreign('type_departement_id')->references('id')->on('type_departements')->onDelete('set null');

            $table->unsignedBigInteger('departement_parent_id')->nullable()->comment('référence du département parent');
            $table->foreign('departement_parent_id')->references('id')->on('departements')->onDelete('set null');

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
            $table->dropForeign(['type_departement_id']);
            $table->dropForeign(['departement_parent_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
