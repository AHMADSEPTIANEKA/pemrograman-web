<!DOCTYPE html>
<html lang="en">

<?php
include "koneksi.php";
session_start();

if(isset($_POST['submit'])){
    $user = $_POST['username'];
    $pass = md5($_POST['password']);

    $query_cek = $mysqli->query("SELECT *  FROM penggunas where username= '$user' AND  password= '$pass'");
    if($query_cek->num_rows > 0)
    {
        $row = mysqli_fetch_assoc($query_cek);
        $_SESSION['username'] = $row['username'];
        echo $_SESSION['username'];
    } else {
        echo "salah";
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perpustakaan</title>
    <style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .login-container {
        background-color: #007bff; 
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 300px; 
        text-align: center;
    }

    .login-container h2 {
        margin-bottom: 20px;
        color: #fff; 
    }

    .login-container label {
        display: block;
        margin-bottom: 8px;
        color: #fff; 
        text-align: left;
    }

    .login-container input {
        width: calc(100% - 16px);
        padding: 10px;
        margin-bottom: 16px;
        box-sizing: border-box;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .login-container button {
        background-color: #4caf50;
        color: #fff;
        padding: 12px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        width: 100%;
        transition: background-color 0.3s;
    }

    .login-container button:hover {
        background-color: #45a049;
    }
    </style>

</head>
<body>
    <div class="login-container">
        <h2>Login Perpustakaan</h2>
        <form action="read.php" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Login</button>
        </form>
    </div>
</body>
</html>
