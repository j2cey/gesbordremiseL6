<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBordereauremiseModepaiesTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'bordereauremise_modepaies';
    public $table_comment = 'Modes de Paiement';

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

            $table->string('titre')->comment('titre du mode de paiement');
            $table->string('code')->unique()->comment('code du mode de paiement');
            $table->string('description')->nullable()->comment('description du mode de paiement');
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
        });
        Schema::dropIfExists($this->table_name);
    }
}
