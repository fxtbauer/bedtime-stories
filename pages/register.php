<?php include('../includes/db_connect.php'); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registrar</title>

  <!-- Bootstrap e ícones -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet"/>

  <!-- CSS local -->
  <link rel="stylesheet" href="../assets/css/stylereg.css"/>
</head>

<body>
  <form id="form-register" method="POST" action="registrar.php" novalidate>
    <div class="container">
      <div id="formHead">
        <h2>Crie sua conta</h2>
        <p>Registre-se para acessar o Histórias para Dormir</p>
      </div>

      <div class="form">

        <div class="inputContainer">
          <label for="usuario">Nome de usuário</label>
          <input class="form-control" type="text" id="usuario" name="usuario" placeholder="Digite seu nome de usuário" required>
        </div>

        <div class="inputContainer">
          <label for="email">E-mail</label>
          <input class="form-control" type="email" id="email" name="email" placeholder="Digite o seu e-mail" required>
        </div>

        <div class="inputContainer">
          <label for="nome_completo">Nome completo</label>
          <input class="form-control" type="text" id="nome_completo" name="nome_completo" placeholder="Digite o seu nome completo" required>
        </div>

        <div class="inputContainer">
          <label for="data_nascimento">Data de nascimento</label>
          <input class="form-control" type="date" id="data_nascimento" name="data_nascimento" required>
        </div>

        <div class="inputContainer">
          <label for="password">Senha</label>
          <input class="form-control" type="password" id="password" name="senha" placeholder="Digite a sua senha" required aria-describedby="pwdHelp">
          <div class="validPwd" id="pwdHelp"><span>Senha inválida!</span></div>
          <a class="requirements"
             tabindex="0"
             data-bs-toggle="popover"
             data-bs-trigger="focus"
             data-bs-title="Requisitos"
             data-bs-content="A senha deve conter pelo menos 8 caracteres e apenas letras e números.">
             <i class="bi bi-info-circle"></i> Requisitos de senha
          </a>
        </div>

        <div class="inputContainer">
          <label for="passwordConfirm">Confirme a senha</label>
          <input class="form-control" type="password" id="passwordConfirm" name="confirmar_senha" placeholder="Digite a sua senha novamente" required>
          <div class="validConf"><span>Senha não coincide!</span></div>
        </div>

      </div>

      <p>Se você já possui uma conta, <a class="link" href="login.php">faça login</a></p>

      <div class="buttonContainer">
        <button type="submit" class="btn btn-success">Registrar</button>
      </div>
    </div>
  </form>

  <!-- Bootstrap bundle (Popper incluso) -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- JS de validação -->
  <script src="../assets/js/register.js"></script>

  <script>
    // Ativa popovers (icones de requisitos)
    document.querySelectorAll('[data-bs-toggle="popover"]').forEach((el) => {
      new bootstrap.Popover(el);
    });
  </script>
</body>
</html>
