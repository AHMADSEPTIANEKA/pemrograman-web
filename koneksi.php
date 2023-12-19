<?php
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'bukuperpustakaan';

$mysqli = new mysqli($host, $username, $password, $dbname);

// Periksa koneksi
if ($mysqli->connect_error) 
    die("Koneksi gagal: " . $mysqli->connect_error);
?>
