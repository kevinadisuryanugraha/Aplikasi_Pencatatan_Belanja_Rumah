<?php
session_start();
require_once 'functions.php';

if (isset($_GET['id'])) {
    $belanja_id = $_GET['id'];

    $belanja = get_belanja_by_id($belanja_id);

    if (!$belanja) {
        echo "Belanja tidak ditemukan atau Anda tidak memiliki akses untuk menghapus belanja ini.";
        exit();
    }

    delete_belanja($belanja_id);
    header("Location: halaman_utama.php");
    exit();
} else {
    header("Location: halaman_utama.php");
    exit();
}
