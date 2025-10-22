<?php


    $DB_HOST = 'localhost';
    $DB_NAME = 'BikeShop';
    $DB_USER = 'root';
    $DB_PASS = '';

function db(){
        global $DB_HOST, $DB_NAME, $DB_USER, $DB_PASS;    
        
        $dsn = "mysql:host=$DB_HOST; dbname=$DB_NAME";

        // return new PDO($dsn, $DB_USER, $DB_PASS);

        try{
            // echo("Connetcted")
            return $pdo = new PDO($dsn, $DB_USER, $DB_PASS);
        } catch (PDOException $e){
            echo("Error: $e");
        }
    }

