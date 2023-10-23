<?php

class Dbh
{
    protected function connect()
    {
        $username = "root";
        $pwd = "";
        try {
            $dbh = new PDO("mysql:host=localhost;dbname=test1", $username, $pwd);
            return $dbh;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage() . "<br>";
        }
    }
}
