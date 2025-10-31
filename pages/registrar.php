<?php
include('../includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: register.php'); exit;
}

$nome = trim($_POST['nomeUsuario'] ?? '');
$email = trim($_POST['email'] ?? '');
$senha = $_POST['senha'] ?? '';
$conf  = $_POST['confirmar_senha'] ?? '';

if ($senha !== $conf) {
    echo "<script>alert('As senhas não coincidem.'); history.back();</script>";
    exit;
}
if (!preg_match('/^[A-Za-z0-9]{8,}$/', $senha)) {
    echo "<script>alert('Senha inválida. Use ao menos 8 caracteres, apenas letras e números.'); history.back();</script>";
    exit;
}

try {
    // checa se já existe e-mail
    $chk = $conn->prepare("SELECT 1 FROM usuario WHERE email = :email LIMIT 1");
    $chk->execute(['email' => $email]);
    if ($chk->fetchColumn()) {
        echo "<script>alert('E-mail já cadastrado.'); history.back();</script>";
        exit;
    }

    $hash = password_hash($senha, PASSWORD_DEFAULT);
    $ins = $conn->prepare("INSERT INTO usuario (nomeUsuario, email, senha) VALUES (:n, :e, :s)");
    $ins->execute(['n' => $nome, 'e' => $email, 's' => $hash]);
    echo "<script>alert('Cadastro realizado! Faça login.'); window.location='login.php';</script>";
} catch (PDOException $e) {
    echo "Erro no cadastro: " . $e->getMessage();
}
