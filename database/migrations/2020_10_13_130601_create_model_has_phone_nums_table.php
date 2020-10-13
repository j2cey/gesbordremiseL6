<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasPhoneNumsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'model_has_phone_nums';
    public $table_comment = 'table de liaison entre un modèle et un numéro de phone.';

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

            $table->unsignedBigInteger('phone_num_id')->nullable()->comment('référence du numéro de phone');
            $table->foreign('phone_num_id')->references('id')->on('phone_nums')->onDelete('set null');

            $table->string('model_type')->comment('type du modèle référencé');
            $table->bigInteger('model_id')->comment('référence du modèle');

            $table->integer('posi')->default(0)->comment('position du numéro de phone dans la liste de numéros.');
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
            $table->dropForeign(['phone_num_id']);
        });
        Schema::dropIfExists($this->table_name);
    }
}
