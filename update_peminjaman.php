<?php
include 'koneksi.php';

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($id <= 0) {
    echo "Invalid ID.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_buku = isset($_POST['nama_buku']) ? $_POST['nama_buku'] : '';
    $tanggal_pinjam = isset($_POST['tanggal_pinjam']) ? $_POST['tanggal_pinjam'] : '';

    // Check if $nama_buku is not empty before updating the database
    if (!empty($nama_buku)) {
        $stmt = $mysqli->prepare("UPDATE peminjaman SET nama_buku=?, tanggal_pinjam=? WHERE peminjaman_id=?");
        $stmt->bind_param("ssi", $nama_buku, $tanggal_pinjam, $id);

        if ($stmt->execute()) {
            header("Location: read_peminjaman.php");
            exit;
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Nama Buku cannot be empty.";
    }
}

$stmt = $mysqli->prepare("SELECT * FROM peminjaman WHERE peminjaman_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
} else {
    echo "Data tidak ditemukan.";
    exit;
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Edit Peminjaman</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
        }

        h2 {
            color: #3498db;
        }

        form {
            text-align: left;
            margin-top: 20px;
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
            background-color: #3498db;
            color: #fff;
            cursor: pointer;
            border: 1px solid #3498db;
            border-radius: 4px;
        }

        form input[type="submit"]:hover {
            background-color: #2980b9;
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
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Peminjaman</h2>
        <form action="update_peminjaman.php?id=<?php echo $id; ?>" method="POST">
            <label for="nama_buku">Nama Buku:</label>
            <input type="text" name="nama_buku" value="<?php echo htmlspecialchars(isset($row['nama_buku']) ? $row['nama_buku'] : ''); ?>"><br>

            <label for="tanggal_pinjam">Tanggal Pinjam:</label>
            <input type="text" name="tanggal_pinjam" value="<?php echo htmlspecialchars(isset($row['tanggal_pinjam']) ? $row['tanggal_pinjam'] : ''); ?>"><br>

            <input type="submit" name="update_peminjaman" value="Perbarui">
        </form>
        <a href="read_peminjaman.php">Kembali</a>
    </div>
</body>
</html>
