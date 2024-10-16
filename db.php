<?php

function connect_db()
{
    $db = new SQLite3('belanja.db');
    return $db;
}

function create_table()
{
    $db = connect_db();
    $db->exec("CREATE TABLE IF NOT EXISTS belanja (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        barang TEXT NOT NULL,
        jumlah INTEGER NOT NULL,
        harga INTEGER NOT NULL,
        tanggal TEXT NOT NULL
    )");
}

create_table();
