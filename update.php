<?php
include 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $sql = "SELECT * FROM bukus WHERE buku_id = $id";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
    $judul = $_POST['judul'];
    $pengarang = $_POST['pengarang'];
    $penerbit = $_POST['penerbit'];
    $tahun_terbit = $_POST['tahun_terbit'];

    $stmt = $mysqli->prepare("UPDATE bukus SET judul=?, pengarang=?, penerbit=?, tahun_terbit=? WHERE buku_id=?");
    $stmt->bind_param("ssssi", $judul, $pengarang, $penerbit, $tahun_terbit, $id);

    if ($stmt->execute()) {
        echo "Data berhasil diperbarui.";
    } else {
        echo "Gagal memperbarui data: " . $stmt->error;
    }

    $stmt->close();
    header("Location: read.php");
    exit();
} else {
    echo "Invalid request.";
    exit();
}

$mysqli->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan - Edit Buku</title>
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

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            text-align: left;
            border: 2px solid #3498db;
        }

        .container input {
            width: calc(100% - 20px);
            margin-bottom: 10px;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #3498db;
            border-radius: 4px;
        }

        .container input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            cursor: pointer;
            border: 1px solid #4CAF50;
            border-radius: 4px;
        }

        .container input[type="submit"]:hover {
            background-color: #45a049;
        }

        .back {
            display: inline-block;
            margin-top: 10px;
            color: #fff;
            text-decoration: none;
            background-color: #3498db;
            padding: 8px 12px;
            border-radius: 4px;
            border: 2px solid #2980b9;
        }

        .back:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Buku</h2>
        <form action="update.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($row['buku_id']) ? $row['buku_id'] : ''; ?>">
            
            <label for="judul">Judul:</label>
            <input type="text" name="judul" value="<?php echo isset($row['judul']) ? $row['judul'] : ''; ?>" required>

            <label for="pengarang">Pengarang:</label>
            <input type="text" name="pengarang" value="<?php echo isset($row['pengarang']) ? $row['pengarang'] : ''; ?>" required>

            <label for="penerbit">Penerbit:</label>
            <input type="text" name="penerbit" value="<?php echo isset($row['penerbit']) ? $row['penerbit'] : ''; ?>" required>

            <label for="tahun_terbit">Tahun Terbit:</label>
            <input type="text" name="tahun_terbit" value="<?php echo isset($row['tahun_terbit']) ? $row['tahun_terbit'] : ''; ?>" required>

            <input type="submit" value="Update">
        </form>
        <a class="back" href="read.php">Kembali</a>
    </div>
</body>
</html>
