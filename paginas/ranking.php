<?php include_once '../config/conexao.php'; ?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>ALEGRATE - Mural de Honra</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:wght@700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f1f5f9; font-family: 'Roboto', sans-serif; }
        .font-chewy { font-family: 'Chewy', cursive; }
        .pos-1 { background: #d4a017 !important; color: white !important; transform: scale(1.1); }
        .rank-card { background: white; border-radius: 20px; padding: 15px; margin-bottom: 10px; display: flex; align-items: center; border: none; }
        .posicao { width: 40px; height: 40px; background: #0056b3; color: white; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="p-5 bg-primary text-white text-center shadow-sm mb-4" style="border-radius: 0 0 40px 40px;">
        <h1 class="font-chewy">Mural de Honra</h1>
    </div>

    <div class="container" style="max-width: 500px;">
        <a href="../index.php" class="btn btn-light rounded-pill mb-4 fw-bold">Voltar</a>

        <?php
        // SQL que une as tabelas para contar presenças reais
        $sql = "SELECT j.nome, COUNT(p.id) as total 
                FROM jovens j 
                LEFT JOIN presencas p ON j.id = p.jovem_id 
                GROUP BY j.id 
                ORDER BY total DESC, j.nome ASC";
        
        $res = $conn->query($sql);
        $pos = 1;

        while($row = $res->fetch_assoc()): ?>
            <div class="rank-card shadow-sm">
                <div class="posicao <?= ($pos == 1) ? 'pos-1' : '' ?>"><?= $pos ?>º</div>
                <div class="flex-grow-1"><strong><?= $row['nome'] ?></strong></div>
                <span class="badge bg-soft-primary text-primary rounded-pill"><?= $row['total'] ?> Presenças</span>
            </div>
        <?php $pos++; endwhile; ?>
    </div>
</body>
</html>