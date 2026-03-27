<?php
include_once '../config/conexao.php';
header('Content-Type: application/json');
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'], $_POST['nome'])) {
    $id = intval($_POST['id']);
    $nome = mysqli_real_escape_string($conn, $_POST['nome']);
    if ($conn->query("UPDATE jovens SET nome = '$nome' WHERE id = $id")) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false]);
    }
}
exit;