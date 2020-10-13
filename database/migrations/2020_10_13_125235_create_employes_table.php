<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployesTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'employes';
    public $table_comment = 'liste des Employes';

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

            $table->string('nom')->comment('nom de l employe');
            $table->string('matricule')->nullable()->comment('matricule de l employe');
            $table->string('prenom')->nullable()->comment('prenom de l employe');
            $table->string('nom_complet')->nullable()->comment('nom complet de l employe');

            $table->string('objectguid')->nullable()->comment('UID');
            $table->string('adresse')->nullable()->comment('adresse de l employe');
            $table->binary('thumbnailphoto')->nullable()->comment('photo de profil de l employe');

            $table->unsignedBigInteger('fonction_employe_id')->nullable()->comment('référence de la fonction de l employé');
            $table->foreign('fonction_employe_id')->references('id')->on('fonction_employes')->onDelete('set null');

            $table->unsignedBigInteger('departement_id')->nullable()->comment('référence du departement d affectation de l employe (le cas echeant)');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('set null');

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
            $table->dropForeign(['fonction_employe_id']);
            $table->dropForeign(['departement_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
