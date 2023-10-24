<?php
const DB_HOST = "127.0.0.1";
const DB_NAME = "CRUD_db";
const DB_PORT = 3306;
const DB_PW = "root";
const DB_USER = "root";

$koneksi = new \mysqli(DB_HOST, DB_USER, DB_PW, DB_NAME, DB_PORT);
if(!$koneksi){
    die("koneksi gagal: ". mysqli_connect_error());
}

$tables = $koneksi->query("show tables like \"perpustakaan\"");

if( ! $tables->num_rows > 0){
    $koneksi->query("CREATE TABLE perpustakaan (
    id INT PRIMARY KEY auto_increment,
    judul VARCHAR(255) NOT NULL,
    pengarang VARCHAR(255) NOT NULL,
    tahun_terbit INT,
    isbn VARCHAR(20)
    )");
}
?>