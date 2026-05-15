<?php
    $dsn = "mysql:host=localhost;dbname=farmacia_db;charset=utf8";
    $usuario = "root";
    $senha = "";
    
    try {
        $pdo = new PDO($dsn, $usuario, $senha);
    } catch (PDOException $e) {
        die("Erro ao conectar: " . $e->getMessage());
    }

?>
