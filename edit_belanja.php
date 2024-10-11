<?php
session_start();
require_once 'functions.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if (isset($_GET['id'])) {
    $belanja_id = $_GET['id'];
    $user_id = $_SESSION['user_id'];

    $belanja = get_belanja_by_id_and_user($belanja_id, $user_id);

    if (!$belanja) {
        echo "Belanja tidak ditemukan atau Anda tidak memiliki akses untuk mengedit belanja ini.";
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $barang = $_POST['barang'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $tanggal = $_POST['tanggal'];

        update_belanja($belanja_id, $barang, $jumlah, $harga, $tanggal, $user_id);
        header("Location: halaman_utama.php");
        exit();
    }
} else {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Belanja</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            padding: 20px;
            color: #333;
        }

        .container {
            max-width: 500px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #5a67d8;
        }

        label {
            font-weight: bold;
            margin-bottom: 5px;
            display: block;
            color: #333;
        }

        input[type="text"],
        input[type="number"],
        input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #5a67d8;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color: #434190;
        }

        a {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #5a67d8;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #434190;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Belanjaan</h2>
        <form action="" method="post">
            <label for="barang">Barang:</label>
            <input type="text" id="barang" name="barang" value="<?php echo htmlspecialchars($belanja['barang']); ?>" required>

            <label for="jumlah">Jumlah:</label>
            <input type="number" id="jumlah" name="jumlah" value="<?php echo htmlspecialchars($belanja['jumlah']); ?>" required>

            <label for="harga">Harga:</label>
            <input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($belanja['harga']); ?>" required>

            <label for="tanggal">Tanggal:</label>
            <input type="date" id="tanggal" name="tanggal" value="<?php echo htmlspecialchars($belanja['tanggal']); ?>" required>

            <input type="submit" value="Update">
        </form>
        <a href="halaman_utama.php">Kembali ke Daftar Belanja</a>
    </div>
</body>

</html>