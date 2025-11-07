<?php
include('../includes/db_connect.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: login.php'); exit;
}
//string
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';

try {
    $stmt = $conn->prepare("SELECT idUsuario, nomeUsuario, email, senha FROM usuario WHERE email = :e LIMIT 1");
    $stmt->execute(['e' => $email]);
    $u = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($u && password_verify($senha, $u['senha'])) {
        $_SESSION['idUsuario']  = $u['idUsuario'];
        $_SESSION['nomeUsuario'] = $u['nomeUsuario'];
        $_SESSION['email']      = $u['email'];
        header('Location: home.php'); exit;
    } else {
        echo "<script>alert('E-mail ou senha incorretos.'); history.back();</script>";
    }
} catch (PDOException $e) {
    echo "Erro no login: " . $e->getMessage();
}
