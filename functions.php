<?php
require_once 'db.php';

function add_belanja($barang, $jumlah, $harga, $tanggal)
{
    $db = connect_db();

    $query = "INSERT INTO belanja (barang, jumlah, harga, tanggal) VALUES ('$barang', $jumlah, $harga, '$tanggal')";
    return $db->exec($query);
}

function ambil_semua_belanja()
{
    $db = connect_db();
    $query = "SELECT * FROM belanja ORDER BY tanggal DESC, harga DESC";
    $result = $db->query($query);

    $belanja = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $belanja[] = $row;
    }
    return $belanja;
}

function get_belanja_by_id($id)
{
    $db = connect_db();
    $query = "SELECT * FROM belanja WHERE id = $id";
    $result = $db->query($query);
    return $result ? $result->fetchArray(SQLITE3_ASSOC) : false;
}

function update_belanja($id, $barang, $jumlah, $harga, $tanggal)
{
    $db = connect_db();

    $query = "UPDATE belanja SET barang = '$barang', jumlah = $jumlah, harga = $harga, tanggal = '$tanggal' WHERE id = $id";
    return $db->exec($query);
}

function delete_belanja($id)
{
    $db = connect_db();
    $query = "DELETE FROM belanja WHERE id = $id";
    return $db->exec($query);
}
