<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserForeignKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->unsignedBigInteger('status_id')->nullable()->comment('référence du statut');
            $table->foreign('status_id')->references('id')->on('statuses')->onDelete('set null');

            $table->unsignedBigInteger('ldap_account_id')->nullable()->comment('référence du compte LDAP');
            $table->foreign('ldap_account_id')->references('id')->on('ldap_accounts')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['status_id']);
            $table->dropForeign(['ldap_account_id']);
        });
    }
}
