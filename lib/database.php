<?php
//create database class with name DatabaseConnection
class DatabaseConnection
{
    //create private property to store the db connection
    public ?PDO $database = null;
    public function getConnection(): PDO
    {
        //create db connection
        if ($this->database == null) {
            $this->database = new PDO('mysql:host=localhost;dbname=blog;charset=utf8', 'root', 'root');
            return $this->database;
        } else {
            return $this->database;
        }
    }
    public function closeConnection(){
        if(!$this->database != null){
            $this->database = null ;
        }
    }
}
