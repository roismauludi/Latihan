<?php
require_once '../config/config.php';

class User {
    private $conn;
    private $table_name = "user";

    public $id;
    public $nim;
    public $nama;
    public $jurusan;
    public $prodi;
    public $kelas;
    public $created_at;
    public $update_at;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }

    // Membaca semua data user
    public function read() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY id DESC";
        $result = mysqli_query($this->conn, $query);
        return $result;
    }

    // Membaca satu user berdasarkan ID
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = " . $this->id;
        $result = mysqli_query($this->conn, $query);
        return mysqli_fetch_assoc($result);
    }

    // Membuat user baru
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " (nim, nama, jurusan, prodi, kelas) VALUES ('$this->nim', '$this->nama', '$this->jurusan', '$this->prodi', '$this->kelas')";
        
        if(mysqli_query($this->conn, $query)) {
            return true;
        }
        return false;
    }

    // Update user
    public function update() {
        $query = "UPDATE " . $this->table_name . " SET nim='$this->nim', nama='$this->nama', jurusan='$this->jurusan', prodi='$this->prodi', kelas='$this->kelas' WHERE id=$this->id";
        
        if(mysqli_query($this->conn, $query)) {
            return true;
        }
        return false;
    }

    // Hapus user
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = " . $this->id;
        
        if(mysqli_query($this->conn, $query)) {
            return true;
        }
        return false;
    }

    // Cek apakah NIM sudah ada
    public function checkNimExists($nim, $exclude_id = null) {
        if($exclude_id) {
            $query = "SELECT id FROM " . $this->table_name . " WHERE nim = '$nim' AND id != $exclude_id";
        } else {
            $query = "SELECT id FROM " . $this->table_name . " WHERE nim = '$nim'";
        }
        
        $result = mysqli_query($this->conn, $query);
        return mysqli_num_rows($result) > 0;
    }
}
?>