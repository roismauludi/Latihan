<?php
class Database {
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "mahasiswa";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try{
            $this->conn = mysqli_connect($this->host, $this->username, $this->password, $this->database);
            if(!$this->conn){
                throw new Exception("Connection error: " . mysqli_connect_error());
            }
            mysqli_set_charset($this->conn, "utf8");
        } catch(Exception $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}

?>