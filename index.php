<?php
session_start();
require_once 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];

    $user = check_user($name, $email);
    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['name'] = $user['name'];
        header("Location: halaman_utama.php");
        exit();
    } elseif ($user === false) {
        echo "Email tidak cocok dengan pengguna";
    } else {
        $db = connect_db();
        add_user($name, $email);
        $_SESSION['user_id'] = $db->lastInsertRowID();
        $_SESSION['name'] = $name;
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pencatatan Belanja Rumah</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            background-color: #FFECC8;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .card {
            background-color: white;
            border-radius: 10px;
            border: 1px solid rgba(0, 0, 0, 0.1);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            padding: 20px;
            text-align: center;
        }

        .card h1 {
            margin-bottom: 20px;
            color: #333;
        }

        .card input[type="text"],
        .card input[type="email"] {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
            width: 100%;
            transition: border 0.3s ease-in-out;
        }

        .card input[type="text"]:focus,
        .card input[type="email"]:focus {
            border: 1px solid #007BFF;
            outline: none;
        }

        .card input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease-in-out;
        }

        .card input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <form action="" method="POST">
                <h1>Masuk Aplikasi Pencatatan Belanja Rumah</h1>
                <input type="text" name="name" placeholder="Masukkan Nama Lengkap" required><br>
                <input type="email" name="email" placeholder="Masukkan Email" required><br>
                <input type="submit" name="submit" value="Masuk"><br>
            </form>
        </div>
    </div>
</body>

</html>