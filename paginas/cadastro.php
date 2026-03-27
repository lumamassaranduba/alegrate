<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>ALEGRA-TE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body { background-color: #f4f7f6; font-family: 'Roboto', sans-serif; }
        .font-chewy { font-family: 'Chewy', cursive; }
        .card-cad { border-radius: 30px; border: none; box-shadow: 0 10px 30px rgba(0,0,0,0.1); margin-top: 50px; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 450px;">
        <div class="card card-cad p-4 text-center">
            <h2 class="font-chewy text-primary mb-4">Novo Membro</h2>
            <form action="../api/salvar_jovem.php" method="POST">
                <input type="text" name="nome" class="form-control form-control-lg rounded-4 bg-light border-0 mb-3" placeholder="Nome completo" required>
                <button type="submit" class="btn btn-primary w-100 py-3 rounded-4 fw-bold shadow-sm" style="background: #0056b3;">CADASTRAR</button>
            </form>
            <a href="../index.php" class="btn btn-link mt-3 text-muted">Voltar</a>
        </div>
    </div>
</body>
</html>