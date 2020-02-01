<?php

    // connection to database by PDO class

    // settings
    $host = 'localhost';
    $user = 'flashback';
    $pass = 'flash850';
    $dbname = 'phonebook';

    // creating query
    $dsn = 'mysql:host=' . $host . ';dbname=' . $dbname;

    // running connection
    try {
        $pdo = new PDO($dsn, $user, $pass);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        echo 'Connection failed: ' . $e->getMessage();
    }
?>