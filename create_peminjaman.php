<?php
include 'koneksi.php';

// Proses form saat metode POST digunakan
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_buku = $_POST['nama_buku'];
    $tanggal_pinjam = $_POST['tanggal_pinjam'];

    // Gunakan prepared statement untuk menghindari SQL injection
    $stmt = $mysqli->prepare("INSERT INTO peminjaman (nama_buku, tanggal_pinjam) VALUES (?, ?)");
    $stmt->bind_param("ss", $nama_buku, $tanggal_pinjam);

    if ($stmt->execute()) {
        // Peminjaman berhasil ditambahkan, redirect ke halaman data peminjaman
        header("Location: read_peminjaman.php");
        exit;
    } else {
        // Pesan kesalahan SQL
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Tambah Peminjaman</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
        }

        form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        form input {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #3498db;
            border-radius: 4px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            border: 1px solid #4CAF50;
            border-radius: 4px;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
            border: 1px solid #3498db;
            padding: 8px;
            border-radius: 4px;
        }

        a:hover {
            text-decoration: underline;
        }

        h2 {
            margin-bottom: 20px;
            color: #3498db;
        }

        p.error-message {
            color: red;
        }

        .link-container {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
<div>
    <form action="create_peminjaman.php" method="POST">
        <h2>Tambah Peminjaman</h2>

        <?php
        // Tampilkan pesan kesalahan jika ada
        if (isset($error_message)) {
            echo "<p class='error-message'>$error_message</p>";
        }
        ?>

        <label for="nama_buku">Nama Buku:</label>
        <input type="text" name="nama_buku" required>

        <label for="tanggal_pinjam">Tanggal Pinjam:</label>
        <input type="date" name="tanggal_pinjam" required>

        <input type="submit" value="Tambah Peminjaman">
    </form>
        <a href="read_peminjaman.php">Kembali ke Data Peminjaman</a>
    </div>
</body>
</html>
