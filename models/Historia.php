<?php

class Historia {

    public static function listarTodas($conn) {
        $sql = "
            SELECT h.idHistoria, h.titulo, h.conteudo, h.dataPublicacao,
                   a.nomeAutor, t.nomeTipo
            FROM historia h
            LEFT JOIN autor a ON h.idAutor = a.idAutor
            LEFT JOIN tipo_historia t ON h.idTipoHistoria = t.idTipoHistoria
            ORDER BY h.dataPublicacao DESC, h.idHistoria DESC";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function inserir($conn, $titulo, $conteudo, $idAutor, $idTipo) {
        $sql = "INSERT INTO historia (titulo, conteudo, idAutor, idTipoHistoria) 
                VALUES (:t, :c, :a, :tp)";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            't' => $titulo,
            'c' => $conteudo,
            'a' => $idAutor,
            'tp' => $idTipo
        ]);
    }

    public static function deletar($conn, $id) {
        $stmt = $conn->prepare("DELETE FROM historia WHERE idHistoria = :id");
        return $stmt->execute(['id' => $id]);
    }

    public static function buscarPorId($conn, $id) {
        $stmt = $conn->prepare("SELECT * FROM historia WHERE idHistoria = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizar($conn, $id, $titulo, $conteudo, $idAutor, $idTipo) {
        $sql = "UPDATE historia SET titulo = :t, conteudo = :c, idAutor = :a, idTipoHistoria = :tp 
                WHERE idHistoria = :id";
        $stmt = $conn->prepare($sql);
        return $stmt->execute([
            't' => $titulo,
            'c' => $conteudo,
            'a' => $idAutor,
            'tp' => $idTipo,
            'id' => $id
        ]);
    }
}
