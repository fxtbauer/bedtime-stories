<?php
session_start();
if (!isset($_SESSION['idUsuario'])) { header('Location: login.php'); exit; }

include('../includes/db_connect.php');
require_once "../models/Historia.php";

// verifica se veio ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID da história inválido.");
}

$idHistoria = (int)$_GET['id'];

// busca a história atual
$historia = Historia::buscarPorId($conn, $idHistoria);
if (!$historia) {
    die("História não encontrada.");
}

// busca dados para os selects
$autores = $conn->query("SELECT idAutor, nomeAutor FROM autor ORDER BY nomeAutor")->fetchAll(PDO::FETCH_ASSOC);
$tipos   = $conn->query("SELECT idTipoHistoria, nomeTipo FROM tipo_historia ORDER BY nomeTipo")->fetchAll(PDO::FETCH_ASSOC);

// se enviou o formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titulo = trim($_POST['titulo']);
    $conteudo = trim($_POST['conteudo']);
    $idAutor = (int)$_POST['idAutor'];
    $idTipo  = (int)$_POST['idTipoHistoria'];

    if ($titulo === "" || $conteudo === "" || !$idAutor || !$idTipo) {
        $erro = "Preencha todos os campos!";
    } else {
        Historia::atualizar($conn, $idHistoria, $titulo, $conteudo, $idAutor, $idTipo);
        header("Location: home.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar História</title>
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-4" style="max-width: 820px;">
    <h3 class="mb-3">✏️ Editar História</h3>

    <?php if (!empty($erro)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($erro); ?></div>
    <?php endif; ?>

    <form method="POST">

        <div class="mb-3">
            <label class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="<?php echo htmlspecialchars($historia['titulo']); ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Autor</label>
            <select name="idAutor" class="form-select" required>
                <?php foreach ($autores as $a): ?>
                    <option value="<?php echo $a['idAutor']; ?>" <?php if ($a['idAutor'] == $historia['idAutor']) echo "selected"; ?>>
                        <?php echo htmlspecialchars($a['nomeAutor']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="idTipoHistoria" class="form-select" required>
                <?php foreach ($tipos as $t): ?>
                    <option value="<?php echo $t['idTipoHistoria']; ?>" <?php if ($t['idTipoHistoria'] == $historia['idTipoHistoria']) echo "selected"; ?>>
                        <?php echo htmlspecialchars($t['nomeTipo']); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-4">
            <label class="form-label">Conteúdo</label>
            <textarea name="conteudo" class="form-control" rows="10" required><?php echo htmlspecialchars($historia['conteudo']); ?></textarea>
        </div>

        <div class="d-flex gap-2">
            <a class="btn btn-outline-secondary" href="home.php">Cancelar</a>
            <button class="btn btn-primary">Salvar alterações</button>
        </div>

    </form>
</div>

</body>
</html>
