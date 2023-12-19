<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $sql = "INSERT INTO bukus (judul, pengarang, penerbit, tahun_terbit) VALUES ('$judul', '$pengarang', '$penerbit', '$tahun_terbit')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Buku berhasil ditambahkan.";
        echo "<br><a href='read.php'>Kembali ke Daftar Buku</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Tambah Buku</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        div {
            text-align: center;
        }

        h2 {
            color: #3498db;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
            margin: auto;
            border: 1px solid #3498db; /* Added border */
        }

        form label {
            display: block;
            margin-top: 10px;
            color: #555;
        }

        form input {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #3498db;
            border-radius: 4px;
            font-size: 14px;
        }

        form input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            border: none;
            border-radius: 4px;
            padding: 10px;
            font-size: 16px;
        }

        form input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back {
            display: inline-block;
            margin-top: 10px;
            color: #3498db;
            text-decoration: none;
            border: 1px solid #3498db;
            padding: 8px;
            border-radius: 4px;
            text-align: center;
        }

        .back:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div>
        <h2>Tambah Buku</h2>
        <form action="create.php" method="POST">
            <label for="judul">Judul:</label>
            <input type="text" name="judul" required>

            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" required>

            <label for="penerbit">Penerbit:</label>
            <input type="text" name="penerbit" required>

            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="text" name="tahun_terbit" required>

            <input type="submit" value="Tambah">
        </form>
        <a class="back" href="read.php">Kembali</a>
    </div>
</body>
</html>
