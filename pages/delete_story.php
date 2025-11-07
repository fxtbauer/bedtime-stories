<?php
include('../includes/db_connect.php');

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID inválido.");
}

$id = (int)$_GET['id'];

try {
    $del = $conn->prepare("DELETE FROM historia WHERE idHistoria = :id");
    $del->execute(['id' => $id]);
    header("Location: home.php");
    exit;

} catch (PDOException $e) {
    echo "Erro ao deletar: " . $e->getMessage();
}
