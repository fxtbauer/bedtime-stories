_<?php
session_start();
if (!isset($_SESSION['idUsuario'])) { header('Location: login.php'); exit; }
include('../includes/db_connect.php');

// Carrega autores e tipos para os selects
$autores = $conn->query("SELECT idAutor, nomeAutor FROM autor ORDER BY nomeAutor")->fetchAll(PDO::FETCH_ASSOC);
$tipos   = $conn->query("SELECT idTipoHistoria, nomeTipo FROM tipo_historia ORDER BY nomeTipo")->fetchAll(PDO::FETCH_ASSOC);

// Inserção
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo'] ?? '');
    $conteudo = trim($_POST['conteudo'] ?? '');
    $idAutor = (int)($_POST['idAutor'] ?? 0);
    $idTipo  = (int)($_POST['idTipoHistoria'] ?? 0);

    if ($titulo === '' || $conteudo === '' || !$idAutor || !$idTipo) {
        $erro = "Preencha todos os campos.";
    } else {
        $ins = $conn->prepare("INSERT INTO historia (titulo, conteudo, idAutor, idTipoHistoria) VALUES (:t,:c,:a,:tp)");
        $ins->execute(['t'=>$titulo,'c'=>$conteudo,'a'=>$idAutor,'tp'=>$idTipo]);
        header('Location: home.php'); exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Criar história</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4" style="max-width:820px">
  <h3 class="mb-3">Adicionar nova história</h3>
  <?php if (!empty($erro)): ?><div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div><?php endif; ?>

  <form method="POST">
    <div class="mb-3">
      <label class="form-label">Título</label>
      <input type="text" class="form-control" name="titulo" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Autor</label>
      <select class="form-select" name="idAutor" required>
        <option value="">Selecione…</option>
        <?php foreach ($autores as $a): ?>
          <option value="<?php echo (int)$a['idAutor']; ?>"><?php echo htmlspecialchars($a['nomeAutor']); ?></option>
        <?php endforeach; ?>
      </select>
      <div class="form-text">Se não houver autores, cadastre um pelo phpMyAdmin (tabela <code>autor</code>).</div>
    </div>

    <div class="mb-3">
      <label class="form-label">Tipo de história</label>
      <select class="form-select" name="idTipoHistoria" required>
        <option value="">Selecione…</option>
        <?php foreach ($tipos as $t): ?>
          <option value="<?php echo (int)$t['idTipoHistoria']; ?>"><?php echo htmlspecialchars($t['nomeTipo']); ?></option>
        <?php endforeach; ?>
      </select>
      <div class="form-text">Configure os tipos em <code>tipo_historia</code> (ex.: Amor, Fantasia, Infantil…).</div>
    </div>

    <div class="mb-4">
      <label class="form-label">Conteúdo</label>
      <textarea class="form-control" name="conteudo" rows="10" required></textarea>
      <div class="form-text">Quebras de linha serão mantidas.</div>
    </div>

    <div class="d-flex gap-2">
      <a href="home.php" class="btn btn-outline-secondary">Cancelar</a>
      <button class="btn btn-success">Salvar história</button>
    </div>
  </form>
</div>
</body>
</html>
