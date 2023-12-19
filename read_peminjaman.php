<?php
include 'koneksi.php';

// Buat prepared statement
$stmt = $mysqli->prepare("SELECT peminjaman_id, nama_buku, tanggal_pinjam FROM peminjaman");

// Jalankan prepared statement
$stmt->execute();

// Dapatkan hasil dari prepared statement
$result = $stmt->get_result();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Data Peminjaman</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            border-radius: 8px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #4CAF50;
            color: white;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        a {
            text-decoration: none;
            padding: 10px;
            margin: 10px;
            display: inline-block;
            color: #fff;
            border-radius: 4px;
            cursor: pointer;
        }

        .Tambah {
            background-color: #3498db;
        }

        .Kembali {
            background-color: #3498db;
        }

        .Edit, .Hapus {
            background-color: #e74c3c;
        }

        .Edit:hover, .Hapus:hover {
            background-color: #c0392b;
        }
    </style>
</head>
<body>
    <h2>Data Peminjaman</h2>   
    <table border='1'>
        <tr>
            <th>ID</th>
            <th>Nama Buku</th>
            <th>Tanggal Pinjam</th>
            <th>Action</th>
        </tr>

        <?php
        // Periksa apakah query berhasil dieksekusi
        if ($result === false) {
            echo "Error: " . $mysqli->error;
        } else {
            // Loop untuk mengambil data
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["peminjaman_id"]."</td>";
                echo "<td>".$row["nama_buku"]."</td>";
                echo "<td>".$row["tanggal_pinjam"]."</td>";
                echo "<td><a class='Edit' href='update_peminjaman.php?id=".$row["peminjaman_id"]."'>Edit</a> | <a class='Hapus' href='delete_peminjaman.php?id=".$row["peminjaman_id"]."'>Hapus</a></td>";
                echo "</tr>";
            }
        }
        ?>
    </table>
    <a class="Tambah" href="create_peminjaman.php">Tambah Peminjaman</a>
    <a class="Kembali" href="read.php">Kembali</a>
</body>
</html>
