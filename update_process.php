<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $stmt = $mysqli->prepare("UPDATE bukus SET judul=?, pengarang=?, penerbit=?, tahun_terbit=? WHERE buku_id=?");
    $stmt->bind_param("ssssi", $judul, $pengarang, $penerbit, $tahun_terbit, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.";

        echo "<br><br><a class='back-button' href='read.php'>Kembali</a>";
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Metode request tidak valid.";
}

$mysqli->close();
?>
