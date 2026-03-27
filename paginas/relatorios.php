<?php include_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>ALEGRATE - Relatórios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background: #f1f5f9; padding: 20px; }
        .card-dia { background: white; border-radius: 20px; padding: 20px; margin-bottom: 15px; border: none; box-shadow: 0 4px 6px rgba(0,0,0,0.05); cursor: pointer; }
        .nomes { display: none; margin-top: 15px; border-top: 1px dashed #ccc; padding-top: 10px; color: #444; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h2 class="text-center mb-4">Histórico</h2>
        <a href="../index.php" class="btn w-100 rounded-pill mb-4" style="background: #0056b3; color: white;">Voltar</a>
        <?php
        $res = $conn->query("SELECT e.id, e.data_encontro, COUNT(p.id) as total FROM encontros e LEFT JOIN presencas p ON e.id = p.encontro_id GROUP BY e.id ORDER BY e.data_encontro DESC");
        while($enc = $res->fetch_assoc()): ?>
            <div class="card-dia shadow-sm" onclick="this.querySelector('.nomes').style.display = (this.querySelector('.nomes').style.display === 'block' ? 'none' : 'block')">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="fw-bold"><?= date('d/m/Y', strtotime($enc['data_encontro'])) ?></span>
                    <span class="badge bg-primary rounded-pill"><?= $enc['total'] ?> jovens</span>
                </div>
                <div class="nomes">
                    <?php
                    $id_e = $enc['id'];
                    $n = $conn->query("SELECT j.nome FROM jovens j JOIN presencas p ON j.id = p.jovem_id WHERE p.encontro_id = $id_e");
                    while($jovem = $n->fetch_assoc()) echo "• " . $jovem['nome'] . "<br>";
                    ?>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>