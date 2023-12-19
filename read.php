
<!DOCTYPE html>
<html lang="en">
<head>
<h2>Data Buku Perpustakaan</h2>
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
            border-radius: 4px;
            cursor: pointer;
        }

        .Tambah {
            background-color: #3498db;
            color: white;
        }

        .Logout {
            background-color: #e74c3c;
            color: white;
        }

        .LihatPeminjaman {
            background-color: #9b59b6;
            color: white;
        }

        .edit-link, .delete-link {
            background-color: #3498db; /* Warna latar untuk tautan Edit dan Hapus */
            color: white; /* Warna teks untuk tautan Edit dan Hapus */
            padding: 8px;
            border-radius: 4px;
            margin-right: 5px;
        }

        .edit-link:hover, .delete-link:hover {
            background-color: #2c3e50; /* Warna latar hover untuk tautan Edit dan Hapus */
        }
    </style>
</head>
<?php
include 'koneksi.php';

$sql = "SELECT * FROM bukus";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>Judul</th><th>Pengarang</th><th>Penerbit</th><th>Tahun Terbit</th><th>Action</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["buku_id"]."</td>";
        echo "<td>".$row["judul"]."</td>";
        echo "<td>".$row["pengarang"]."</td>";
        echo "<td>".$row["penerbit"]."</td>";
        echo "<td>".$row["tahun_terbit"]."</td>";
        echo "<td><a class='edit-link' href='update.php?id=".$row["buku_id"]."'>Edit</a> | <a class='delete-link' href='delete.php?id=".$row["buku_id"]."'>Hapus</a></td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "Tidak ada data buku.";
}

$mysqli->close();
?>

<body>
    <a class="Tambah" href="create.php">Tambah</a>
    <a class="Logout" href="logout.php">Log Out</a>
    <a class="LihatPeminjaman" href="read_peminjaman.php">Lihat Peminjaman</a>
</body>
</html>

