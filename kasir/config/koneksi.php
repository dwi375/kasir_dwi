<?php
$servername = "localhost";
$username = "root";
$password= "";
$dbname = "kasir";

$conn = new mysqli($servername,$username,$password,$dbname);

if ($conn->connect_error) {
    die("koneksi gagal:" . $conn->connect_error);
}


?>
