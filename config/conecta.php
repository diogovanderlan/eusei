<?php
  try {
    $servidor = "localhost";
    $banco = "eusei";
    $usuario = "root";
    $senha = "vanderlan12365221";

    $pdo = new PDO ("mysql:host=$servidor;dbname=$banco;charset=utf8","$usuario","$senha");

  } catch (PDOException $e) {
    echo "Erro de Conexão " . $e->getMessage();
    exit;
  }