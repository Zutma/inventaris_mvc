<?php
$host = 'localhost';
$user = 'root';
$password = '';
$db   = 'db_inventaris';

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}