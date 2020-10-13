<?php

use App\Traits\Migrations\BaseMigrationTrait;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLdapAccountImportsTable extends Migration
{
    use BaseMigrationTrait;

    public $table_name = 'ldap_account_imports';
    public $table_comment = 'derniere importation LDAP';

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

            $table->string('objectguid')->nullable()->comment('GUID du compte');
            $table->string('username')->nullable()->comment('Account Name');
            $table->string('name')->nullable()->comment('nom complet du compte');

            $table->string('email')->nullable()->comment('e-mail du compte');
            $table->string('password')->nullable()->comment('mot de passe du compte');
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
