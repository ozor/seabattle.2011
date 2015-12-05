<?php

/**
 * Работа с БД здесь организована через PDO посредством Zend_Db.
 *
 * @author Ушаков Денис. Тестовое задание.
 */

class DB
{
    private static $db;

    private function  __construct() {}

    public static function get()
    {
        if ( is_null(self::$db) ) {
          self::$db = Zend_Db::factory('PDO_MYSQL', array(
                    'host'     => DB_HOST,
                    'username' => DB_USER,
                    'password' => DB_PASSWORD,
                    'dbname'   => DB_NAME
                ));
          self::$db->query("SET NAMES utf8");
          self::$db->setFetchMode(Zend_Db::FETCH_OBJ);
        }

        return self::$db;
    }
}