<?php
/**
 * Created by PhpStorm.
 * User: Arn
 * Date: 2018-08-13
 * Time: 16:11
 */

include 'C:\xampp\htdocs\Football\config.php';
class user
{
    private $database;
    private $name;
    private $password;
    private $role;
    public function __construct()
    {
        $this->database = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
        if(mysqli_connect_errno()){
            echo "Error: Could not connect to database.";
            exit;
        }
    }

    public function user_registration($name,$password)
    {
        $role = 1;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        if($this->check_availability($name)){
            $prepare = $this->database->prepare("INSERT INTO users (name, password, role) 
                      VALUES (?, ?, ?)");
            $prepare->bind_param("ssi", $name, $hashed_password, $role);
            if($prepare->execute()){
                return $prepare;
            }
            else return false;
        }
        else return false;
    }

    public function check_availability($name)
    {
        $prepare = $this->database->prepare("SELECT * FROM users where name = ?");
        $prepare->bind_param("s",$name);
        $prepare->execute() or die(mysqli_connect_errno() . "Name availability cannot be checked");
        if($prepare->num_rows == 0)
            return true;
        else return false;
    }

    public function user_login($name,$password)
    {
        $prepare = $this->database->prepare("SELECT * FROM users where name = ?");
        $prepare->bind_param("s",$name);
        $prepare->execute() or die(mysqli_connect_errno() . "User cannot be logged in");
        $result = $prepare->get_result();
        $row = mysqli_fetch_assoc($result);
        $hashed_pw = $row['password'];
        $password_check = password_verify($password, $hashed_pw);
        if(!$password_check) {
            $_SESSION['error'] = "password is not correct";
            return false;
        }
        if($row['name'] == $name && $password_check) {
            $_SESSION['user_login'] = TRUE;
            $_SESSION['user_id'] = $row['ID'];
            return true;
        }
        else
            return false;
    }
    /*
     * 1 - user
     * 2 - admin
     */
    public function get_role()
    {
        $prepare = $this->database->prepare("SELECT role FROM users where name = ?");
        $prepare->bind_param("s",$this->name);
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get user role");
        $result = $prepare->get_result();
        $row = mysqli_fetch_array(($result));
        return $row['role'];
    }

   /* public function get_session()
    {
        return $_SESSION['user_login'];
    }*/

    public function user_logout()
    {
        $_SESSION['user_login'] = FALSE;
        session_destroy();
    }
}