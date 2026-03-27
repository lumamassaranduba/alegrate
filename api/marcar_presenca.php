<?php
include_once '../config/conexao.php';
header('Content-Type: application/json');

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $hoje = date('Y-m-d');
    
    // 1. Verifica se o encontro de hoje existe
    $res = $conn->query("SELECT id FROM encontros WHERE data_encontro = '$hoje'");
    if($res->num_rows > 0) { 
        $enc_id = $res->fetch_assoc()['id']; 
    } else { 
        $conn->query("INSERT INTO encontros (data_encontro) VALUES ('$hoje')"); 
        $enc_id = $conn->insert_id; 
    }
    
    // 2. Verifica se JÁ EXISTE presença para este jovem hoje
    $checar = $conn->query("SELECT id FROM presencas WHERE jovem_id = $id AND encontro_id = $enc_id");
    
    if($checar->num_rows > 0) {
        // Se já existe, clico de novo para REMOVER (Desmarcar)
        $conn->query("DELETE FROM presencas WHERE jovem_id = $id AND encontro_id = $enc_id");
        echo json_encode(['success' => true, 'action' => 'desmarcado']);
    } else {
        // Se não existe, clico para ADICIONAR (Marcar)
        $conn->query("INSERT INTO presencas (jovem_id, encontro_id) VALUES ($id, $enc_id)");
        echo json_encode(['success' => true, 'action' => 'marcado']);
    }
}
exit;