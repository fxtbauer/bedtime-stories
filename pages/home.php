<?php
session_start();
if (!isset($_SESSION['idUsuario'])) { header('Location: login.php'); exit; }

include('../includes/db_connect.php');

// Busca histórias + autor + tipo
require_once "../models/Historia.php";
$historias = Historia::listarTodas($conn);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>🌙 Histórias para Dormir</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body{background-color: #c9d6ff;font-family:system-ui,-apple-system,Segoe UI,Roboto}
    .story-card{background:#fff;border-radius:16px;box-shadow:0 4px 12px rgba(0,0,0,.08);padding:20px;margin:16px auto;max-width:800px}
    .topbar{position:sticky;top:0;background:#ffffffcc;backdrop-filter:saturate(1.2) blur(6px);border-bottom:1px solid #e9ecef}
  </style>
</head>
<body>
  <nav class="topbar py-2">
    <div class="container d-flex justify-content-between align-items-center">
      <strong>🌙 Histórias para Dormir</strong>
      <div>
        <span class="me-3">Olá, <?php echo htmlspecialchars($_SESSION['nomeUsuario']); ?>!</span>
        <a class="btn btn-outline-secondary btn-sm" href="add_story.php">+ Nova história</a>
        <a class="btn btn-danger btn-sm" href="logout.php">Sair</a>
      </div>
    </div>
  </nav>

  <div class="container mt-4">
    <?php if ($historias): ?>
      <?php foreach ($historias as $h): ?>
        <article class="story-card">
          <h3 class="mb-2"><?php echo htmlspecialchars($h['titulo']); ?></h3>
          <p class="mb-2"><?php echo nl2br(htmlspecialchars($h['conteudo'])); ?></p>
          <small class="text-muted">
            ✍️ Autor: <strong><?php echo htmlspecialchars($h['nomeAutor'] ?? '—'); ?></strong> ·
            🏷️ Tipo: <?php echo htmlspecialchars($h['nomeTipo'] ?? '—'); ?> ·
            📅 <?php echo date('d/m/Y', strtotime($h['dataPublicacao'])); ?>
          </small>
          <small class="text-muted">
  ✍️ Autor: <strong><?php echo htmlspecialchars($h['nomeAutor'] ?? '—'); ?></strong> ·
  🏷️ Tipo: <?php echo htmlspecialchars($h['nomeTipo'] ?? '—'); ?> ·
  📅 <?php echo date('d/m/Y', strtotime($h['dataPublicacao'])); ?>
</small>

<div class="mt-2">
  <a href="delete_story.php?id=<?php echo $h['idHistoria']; ?>" 
     class="btn btn-sm btn-outline-danger"
     onclick="return confirm('Tem certeza que deseja excluir esta história?');">
     🗑️ Excluir
  </a>
</div>

        </article>
      <?php endforeach; ?>
    <?php else: ?>
      <div class="alert alert-info text-center">Nenhuma história ainda. Que tal <a href="add_story.php">criar a primeira?</a></div>
    <?php endif; ?>
  </div>
</body>
</html>
