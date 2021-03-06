<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasEmailAddressesTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'model_has_email_addresses';
    public $table_comment = 'table de liaison entre un modèle et une addresse e-mail.';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create($this->table_name, function (Blueprint $table) {
            $table->bigIncrements('id');
            //$table->baseFields();

            $table->unsignedBigInteger('email_address_id')->nullable()->comment('référence de l adresse e-mail');
            $table->foreign('email_address_id')->references('id')->on('email_addresses')->onDelete('set null');

            $table->string('model_type')->comment('type du modèle référencé');
            $table->bigInteger('model_id')->comment('référence du modèle');

            $table->integer('posi')->default(0)->comment('position du numéro de l adresse e-mail dans la liste d adresses.');
            //$table->index(['employe_id','rang']);
            $table->timestamps();
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
            //$table->dropBaseForeigns();
            $table->dropForeign(['email_address_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
