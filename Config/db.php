<?php

class Database
{
    public static $host = 'localhost';
    public static $dbname = 'todo';
    public static $user = 'root';
    public static $password = '';

    private static $bdd = null;

    private function __construct()
    {
    }

    public static function getBdd()
    {
        if (is_null(self::$bdd)) {
            self::$bdd = new PDO("mysql:host=" . self::$host . ";dbname=" . self::$dbname . "", self::$user, self::$password);
        }

        return self::$bdd;
    }
}

?>