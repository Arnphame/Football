<?php
/**
 * Created by PhpStorm.
 * User: Arn
 * Date: 2018-08-13
 * Time: 16:11
 */

include_once 'C:\xampp\htdocs\Football\config.php';
class user
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

    public function user_registration($name, $email, $password)
    {
        $role = 1;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $prepare = $this->database->prepare("INSERT INTO users (name, email, password, role) 
                      VALUES (?, ?, ?, ?)");
            $prepare->bind_param("sssi", $name, $email, $hashed_password, $role);
            if($prepare->execute()){
                return $prepare;
            }
            else return false;
    }

    public function check_availability($name)
    {
        $prepare = $this->database->prepare("SELECT * FROM users where name = ?");
        $prepare->bind_param("s",$name);
        $prepare->execute() or die(mysqli_connect_errno() . "Name availability cannot be checked");
        $prepare->store_result();
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
    public function getUser($id)
    {
        $prepare = $this->database->prepare("SELECT id, email, name, role FROM users where id = ?");
        $prepare->bind_param("i", $id);
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get user");
        if($prepare) {
            $result = $prepare->get_result();
            return $result;
        }
        else return false;
    }
    public function getUserByEmail($email)
    {
        $prepare = $this->database->prepare("SELECT name FROM users where email = ?");
        $prepare->bind_param("s", $email);
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get user");
        if($prepare) {
            $result = $prepare->get_result();
            return $result;
        }
        else return false;
    }

    public function user_logout()
    {
        $_SESSION['user_login'] = FALSE;
        session_destroy();
    }

    public function check_email($email)
    {
        $prepare = $this->database->prepare("SELECT * FROM users where email = ?");
        $prepare->bind_param("s",$email);
        $prepare->execute() or die(mysqli_connect_errno() . "Cannot get user");
        $prepare->store_result();
        if($prepare->num_rows == 1)
            return true;
        else return false;
    }

    public function set_token($email)
    {
        if ($this->check_email($email)) {
            $token = md5(uniqid($email, true));
            $prepare = $this->database->prepare("UPDATE users SET token = ? WHERE email = ?");
            $prepare->bind_param("ss", $token, $email);
            if ($prepare->execute())
                return $prepare;
            else return false;
        }
        return false;
    }
}