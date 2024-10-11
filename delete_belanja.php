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
        echo "Belanja tidak ditemukan atau Anda tidak memiliki akses untuk menghapus belanja ini.";
        exit();
    }

    delete_belanja($belanja_id, $user_id);
    header("Location: halaman_utama.php");
    exit();
} else {
    header("Location: index.php");
    exit();
}
