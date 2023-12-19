<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM peminjaman WHERE peminjaman_id=$id";

    if ($mysqli->query($sql) === TRUE) {
        header("Location: read_peminjaman.php");
        exit;
    } else {
        echo "Error deleting record: " . $mysqli->error;
    }
} else {
    echo "Invalid Request";
    exit;
}
?>
