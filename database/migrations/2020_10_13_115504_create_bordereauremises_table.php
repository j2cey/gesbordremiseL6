<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBordereauremisesTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'bordereauremises';
    public $table_comment = 'bordereaux de remise';
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

            $table->string('fichier_source')->nullable()->comment('fichier source du bordereau');
            $table->timestamp('date_remise')->nullable()->comment('date de remise');
            $table->string('numero_transaction')->nullable()->comment('numéro de transaction');
            $table->string('localisation')->nullable()->comment('localisation');
            $table->string('changement_dernier_tarif')->nullable()->comment('changement dernier tarif');
            $table->string('classe_paiement')->nullable()->comment('classe de paiement');
            $table->string('montant_total')->nullable()->comment('montant total');
            // Champs à modifier par le workflow (Agence)
            $table->timestamp('date_depot_agence')->nullable()->comment('date de depot agence');
            $table->integer('montant_depose_agence')->nullable()->comment('montant déposé (agence)');
            $table->string('scan_bordereau')->nullable()->comment('fichier scan du bordereau');
            $table->string('commentaire_agence')->nullable()->comment('commentaire agence');
            // Champs à modifier par le workflow (Finance)
            $table->timestamp('date_valeur')->nullable()->comment('date valeur');
            $table->integer('montant_depose_finance')->nullable()->comment('montant déposé (finance)');
            $table->string('commentaire_finance')->nullable()->comment('commentaire finance');

            $table->unsignedBigInteger('bordereauremise_loc_id')->nullable()->comment('référence de la localisation');
            $table->foreign('bordereauremise_loc_id')->references('id')->on('bordereauremise_locs')->onDelete('set null');

            $table->unsignedBigInteger('bordereauremise_modepaie_id')->nullable()->comment('référence de la localisation');
            $table->foreign('bordereauremise_modepaie_id')->references('id')->on('bordereauremise_modepaies')->onDelete('set null');

            //TODO: Retirer ces champs après normalisation
            $table->string('localisation_titre')->nullable()->comment('titre de la localisation');
            $table->string('modepaiement_titre')->nullable()->comment('titre du mode de paiement');
            $table->string('workflow_currentstep_titre')->nullable()->comment('titre de l étape de traitement actuelle, le cas échéant.');
            $table->string('workflow_currentstep_code')->nullable()->comment('code de l étape de traitement actuelle, le cas échéant.');
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
            $table->dropForeign(['bordereauremise_loc_id']);
            $table->dropForeign(['bordereauremise_modepaie_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
