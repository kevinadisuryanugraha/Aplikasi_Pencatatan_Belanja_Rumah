<?php

function connect_db()
{
    $db = new SQLite3('belanja.db');
    return $db;
}

function create_table()
{
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS users (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        email TEXT NOT NULL UNIQUE
    )");

    $db->exec("CREATE TABLE IF NOT EXISTS belanja (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        barang TEXT NOT NULL,
        jumlah INTEGER NOT NULL,
        harga INTEGER NOT NULL,
        tanggal TEXT NOT NULL,
        user_id INTEGER NOT NULL,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )");
}

create_table();
