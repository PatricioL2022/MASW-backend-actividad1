<?php
/**
 * Created by PhpStorm.
 * User: Patricio Landa ( alandam@student.universidadviu.com )
 * Date: 17/6/2024
 * Time: 23:31
 */

class ConnectionDB
{
    private $db_host;
    private $db_user;
    private $db_password;
    private $db_name;

    public function __construct()
    {
        $this->db_host = "localhost";
        $this->db_user = "root";
        $this->db_password = "root";
        $this->db_name = "actividad1grupo4";
    }

    public function initConnectionDb(){
        $mysqli = @new mysqli(
            $this->db_host,
            $this->db_user,
            $this->db_password,
            $this->db_name);
            
        if($mysqli->connect_error)
        {
            die('Error: '.$mysqli->connect_error);
        }
        return $mysqli;
    }


}