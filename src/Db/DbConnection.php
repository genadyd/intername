<?php
/**
 * Created by PhpStorm.
 * User: Genady
 * Date: 1/31/21
 * Time: 6:09 PM
 */


namespace App\Db;


class DbConnection
{
    private function __construct()
    {
    } /*close static class*/

    private static $instanse = NULL;

    public static function getConnection(): \PDO
    {
        if (is_null(self::$instanse)) {
            self::$instanse = new self();
        }
        return self::$instanse->connection();
    }

    private function connection(): \PDO|bool
    {
        require './src/config.php';
        /** @var $getConfig */
        $db_config = $getConfig('Db');
        try {
            return new \PDO('mysql:host=' . $db_config['host'] . ';dbname=' . $db_config['db_name'], $db_config['db_user'], $db_config['db_pass']);
        } catch (\Exception $e) {
            echo 'Connection failed: ' . $e;
            return false;
        }

    }


}
