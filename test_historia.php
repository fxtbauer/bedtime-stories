<?php
// Inclui a conexão com o banco
include('includes/db_connect.php');

try {
    // Consulta todas as histórias com autor e tipo
    $sql = "
        SELECT 
            h.idHistoria,
            h.titulo,
            h.conteudo,
            a.nomeAutor,
            t.nomeTipo,
            h.dataPublicacao
        FROM historia h
        LEFT JOIN autor a ON h.idAutor = a.idAutor
        LEFT JOIN tipo_historia t ON h.idTipoHistoria = t.idTipoHistoria
        ORDER BY h.dataPublicacao DESC
    ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $historias = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro ao consultar: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Teste de Histórias</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h1 class="text-center mb-4">📖 Teste de Histórias no Banco</h1>

        <?php if (count($historias) > 0): ?>
            <?php foreach ($historias as $historia): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h4 class="card-title"><?php echo htmlspecialchars($historia['titulo']); ?></h4>
                        <p class="card-text"><?php echo nl2br(htmlspecialchars($historia['conteudo'])); ?></p>
                        <hr>
                        <small class="text-muted">
                            ✍️ Autor: <strong><?php echo htmlspecialchars($historia['nomeAutor']); ?></strong><br>
                            🏷️ Tipo: <?php echo htmlspecialchars($historia['nomeTipo'] ?? '—'); ?><br>
                            📅 Data: <?php echo htmlspecialchars($historia['dataPublicacao']); ?>
                        </small>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-danger">Nenhuma história encontrada no banco.</p>
        <?php endif; ?>
    </div>
</body>
</html>
