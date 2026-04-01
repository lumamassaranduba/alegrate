<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ALEGRA-TE</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Chewy&family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root { --azul: #0056b3; --rosa: #b3001b; }
        body { font-family: 'Roboto', sans-serif; background: #f4f7f6; }
        .hero { background: linear-gradient(135deg, #0056b3, #1da1f2); color: white; padding: 60px 20px; border-radius: 0 0 50px 50px; text-align: center; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .font-chewy { font-family: 'Chewy', cursive; }
        .menu-card { background: white; border-radius: 25px; padding: 20px; margin-bottom: 15px; display: flex; align-items: center; text-decoration: none !important; color: var(--azul) !important; transition: 0.3s; border: none; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .icon-box { width: 55px; height: 55px; background: #f0f4f8; border-radius: 18px; display: flex; align-items: center; justify-content: center; margin-right: 15px; font-size: 22px; transition: 0.3s; }
        .menu-card:hover .icon-box { background: var(--rosa); color: white; }
        .toast-container { position: fixed; bottom: 20px; right: 20px; z-index: 1050; }
    </style>
</head>
<body>

    <div class="toast-container">
        <div id="toastSucesso" class="toast align-items-center text-white bg-success border-0 shadow-lg" role="alert">
            <div class="d-flex">
                <div class="toast-body fw-bold">✅ Jovem cadastrado com sucesso!</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>

    <div class="hero mb-4">
        <img src="logo_alegrate.png" alt="Logo" style="max-width: 150px;" onerror="this.style.display='none'">
        <h1 class="font-chewy display-4">ALEGRA-TE</h1>
        <p class="text-uppercase fw-bold opacity-75">A alegria do Senhor é a nossa força! </p>
    </div>

    <div class="container" style="max-width: 450px;">
        <a href="paginas/chamada.php" class="menu-card shadow-sm">
            <div class="icon-box"><i class="fas fa-list-check"></i></div>
            <div><h5 class="mb-0 font-chewy">Fazer Chamada</h5><small class="text-muted">Registar presenças de hoje</small></div>
        </a>
        <a href="paginas/cadastro.php" class="menu-card shadow-sm">
            <div class="icon-box"><i class="fas fa-user-plus"></i></div>
            <div><h5 class="mb-0 font-chewy">Novo Jovem</h5><small class="text-muted">Adicionar participante</small></div>
        </a>
        <a href="paginas/ranking.php" class="menu-card shadow-sm">
            <div class="icon-box"><i class="fas fa-crown"></i></div>
            <div><h5 class="mb-0 font-chewy">Ranking</h5><small class="text-muted">Mural de honra dos assíduos</small></div>
        </a>
        <a href="paginas/relatorios.php" class="menu-card shadow-sm">
            <div class="icon-box"><i class="fas fa-calendar-days"></i></div>
            <div><h5 class="mb-0 font-chewy">Relatórios</h5><small class="text-muted">Histórico de presenças por data</small></div>
        </a>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('status') === 'sucesso'){
            const t = document.getElementById('toastSucesso');
            new bootstrap.Toast(t).show();
            window.history.replaceState({}, '', window.location.pathname);
        }
    </script>
</body>
</html>