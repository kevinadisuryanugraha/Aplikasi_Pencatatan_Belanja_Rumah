<?php
session_start();
require_once 'functions.php';

$belanja_list = ambil_semua_belanja();
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
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            padding: 20px;
        }

        h2 {
            text-align: center;
            color: #5a67d8;
            margin-bottom: 20px;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        a {
            text-decoration: none;
            color: #fff;
            background-color: #5a67d8;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        a:hover {
            background-color: #434190;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background-color: #fff;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table thead {
            background-color: #5a67d8;
            color: #fff;
        }

        table thead th {
            padding: 12px 15px;
            text-align: left;
        }

        table tbody td {
            padding: 12px 15px;
            border-bottom: 1px solid #eee;
        }

        table tbody tr:nth-child(even) {
            background-color: #f4f4f9;
        }

        .actions a {
            margin-right: 10px;
            padding: 8px 12px;
            color: #fff;
            border-radius: 5px;
            font-size: 14px;
        }

        .edit {
            background-color: #2b6cb0;
        }

        .delete {
            background-color: #e53e3e;
        }

        .edit:hover {
            background-color: #2c5282;
        }

        .delete:hover {
            background-color: #c53030;
        }

        .no-data {
            text-align: center;
            padding: 15px;
            font-size: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Pencatatan Belanja Rumah</h2>
        <div style="text-align: right;">
            <a href="tambah_catatan.php">Tambah Belanja</a>
        </div>

        <table>
            <thead>
                <tr>
                    <th>Barang</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($belanja_list)): ?>
                    <tr>
                        <td colspan="5" class="no-data">Tidak ada belanjaan yang tercatat.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($belanja_list as $belanja): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($belanja['barang']); ?></td>
                            <td><?php echo htmlspecialchars($belanja['jumlah']); ?></td>
                            <td>Rp. <?php echo number_format($belanja['harga'], 0, ',', '.'); ?></td>
                            <td><?php echo htmlspecialchars($belanja['tanggal']); ?></td>
                            <td class="actions">
                                <a href="edit_belanja.php?id=<?php echo $belanja['id']; ?>" class="edit">Edit</a>
                                <a href="delete_belanja.php?id=<?php echo $belanja['id']; ?>" class="delete" onclick="return confirm('Anda yakin ingin menghapus catatan belanja ini?');">Hapus</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>