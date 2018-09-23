<?php
/**
 * Created by PhpStorm.
 * User: Arn
 * Date: 2018-09-23
 * Time: 14:44
 */
include_once 'C:\xampp\htdocs\Football\config.php';
class match
{
    private $database;
    public function __construct()
    {
        $this->database = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if(mysqli_connect_errno()){
            echo "Error: Could not connect to database.";
            exit;
        }
    }

    /**
     * status: 0 -> users can join
     * status: 1 -> match is full
     * status: 2 -> match declined
     */
    public function create_match($date, $location)
    {
        $status = 0;
        $prepare = $this->database->prepare("INSERT INTO matches (date, location, status) 
                      VALUES (?, ?, ?)");
        $prepare->bind_param("ssi", $date, $location, $status);
        if($prepare->execute()){
            return $prepare;
        }
        else return false;
    }
    public function getMatch($id)
    {
        $prepare = $this->database->prepare("SELECT id, date, location, status FROM matches where id = ?");
        $prepare->bind_param("i", $id);
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get match");
        if($prepare) {
            $result = $prepare->get_result();

            var_dump($result);
            //return $result;
            die();
        }
        else return false;
    }
    public function getAllMatches()
    {
        $prepare = $this->database->prepare("SELECT id, date, location, status FROM matches");
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get matches");
        if($prepare) {
            $prepare->execute();
            return $prepare;
        }
        else return false;
    }
}