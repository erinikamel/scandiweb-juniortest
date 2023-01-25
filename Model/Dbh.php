<?php

abstract class Dbh 
{
    protected function connect ()
    {
        try {
            $username = "root";
            $password = "";
            $pdo = new PDO ('mysql:host=localhost;dbname=juniortestscandiweb', $username, $password);
            $pdo->setAttribute (PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            return $pdo;
        } catch (PDOException $e) {
            print "Error:" . $e->getMessage() . "</br>";
            die();
        }
    }
}
