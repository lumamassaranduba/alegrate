<?php
include_once '../config/conexao.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nome'])) {
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    if($conn->query("INSERT INTO jovens (nome) VALUES ('$nome')")) {
        header("Location: ../index.php?status=sucesso");
        exit();
    }
}
?>