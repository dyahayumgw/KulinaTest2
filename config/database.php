<?php
/**
 * Created by PhpStorm.
 * User: Ryandhimas
 * Date: 8/7/2018
 * Time: 8:56 PM
 */

class database
{

    // specify your own database credentials
    private $host = "localhost";
    private $db_name = "kulina_api_db";
    private $username = "root";
    private $password = "";
    public $conn;

    // get the database connection
    public function getConnection(){

        $this->conn = null;

        try{
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }

        return $this->conn;
    }

}