<?php
require_once 'db.php';

function check_user($name, $email)
{
    $db = connect_db();

    $query = "SELECT * FROM users WHERE name = '$name'";
    $result = $db->query($query);
    $user = $result->fetchArray(SQLITE3_ASSOC);

    if ($user) {
        return $user['email'] === $email ? $user : false;
    }
    return null;
}

function add_user($name, $email)
{
    $db = connect_db();

    if (check_user($name, $email)) {
        return true;
    }

    $query = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
    return $db->exec($query);
}

function add_belanja($barang, $jumlah, $harga, $tanggal, $user_id)
{
    $db = connect_db();

    $query = "INSERT INTO belanja (barang, jumlah, harga, tanggal, user_id) VALUES ('$barang', $jumlah, $harga, '$tanggal', $user_id)";
    return $db->exec($query);
}

function ambil_belanja_by_user($user_id)
{
    $db = connect_db();
    $query = "SELECT * FROM belanja WHERE user_id = $user_id order by tanggal DESC";
    $result = $db->query($query);

    $belanja = [];
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        $belanja[] = $row;
    }
    return $belanja;
}

function get_belanja_by_id_and_user($id, $user_id)
{
    $db = connect_db();
    $query = "SELECT * FROM belanja WHERE id = $id AND user_id = $user_id";
    $result = $db->query($query);
    return $result ? $result->fetchArray(SQLITE3_ASSOC) : false;
}

function update_belanja($id, $barang, $jumlah, $harga, $tanggal, $user_id)
{
    $db = connect_db();

    $query = "UPDATE belanja SET barang = '$barang', jumlah = $jumlah, harga = $harga, tanggal = '$tanggal' WHERE id = $id AND user_id = $user_id";
    return $db->exec($query);
}

function delete_belanja($id, $user_id)
{
    $db = connect_db();
    $query = "DELETE FROM belanja WHERE id = $id AND user_id = $user_id";
    return $db->exec($query);
}
