<?php include('../includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap e ícones -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- CSS local -->
    <link rel="stylesheet" href="../assets/css/stylereg.css">
</head>

<body>
    <form method="POST" action="autenticar.php">
        <div class="container">
            <div id="formHead">
                <h2>Login</h2>
                <p>Entre em sua conta para acessar o Histórias para Dormir</p>
            </div>

            <div class="form">
                <div class="inputContainer">
                    <label for="email">E-mail</label>
                    <input placeholder="Digite o seu e-mail" class="form-control" type="email" name="email" required>
                </div>

                <div class="inputContainer">
                    <label for="senha">Senha</label>
                    <input placeholder="Digite a sua senha" class="form-control" type="password" name="senha" required>
                </div>
            </div>

            <a class="link" href="#">Esqueceu a senha?</a>
            <p>Se você é novo por aqui, <a class="link" href="register.php">registre-se</a></p>

            <div class="buttonContainer">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>
        </div>
    </form>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/login.js"></script>
</body>

</html>
