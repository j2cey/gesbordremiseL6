<?php


namespace App\Traits\Migrations;

use Illuminate\Support\Facades\DB;
use PDO;

trait BaseMigrationTrait
{
    /**
     * Set table comment
     *
     * @param $table_name
     * @param $table_comment
     */
    public function setTableComment($table_name, $table_comment) {
        switch(DB::connection()->getPDO()->getAttribute(PDO::ATTR_DRIVER_NAME))
        {
            case 'mysql':
                DB::statement("ALTER TABLE `".$table_name."` comment '{$table_comment}'");
                break;
            case 'pgsql':
                DB::statement("COMMENT ON TABLE {$table_name} IS '{$table_comment}'");
                break;
            case 'sqlite':
                //sqlite syntax
                break;
            default:
                //throw new \Exception('Driver not supported.');
                break;
        }
    }
}
