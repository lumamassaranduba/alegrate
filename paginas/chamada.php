<?php 
include_once '../config/conexao.php'; 
$hoje = date('Y-m-d');
?>
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
        :root { --azul: #0056b3; --rosa: #b3001b; --bg: #f8fafc; }
        body { background-color: var(--bg); font-family: 'Roboto', sans-serif; }
        .font-chewy { font-family: 'Chewy', cursive; }
        .header-top { background: linear-gradient(135deg, var(--azul) 0%, #1da1f2 100%); color: white; padding: 30px; border-radius: 0 0 40px 40px; text-align: center; }
        .search-box { position: relative; margin-top: -25px; margin-bottom: 20px; }
        .search-input { border-radius: 25px; border: none; padding: 15px 50px; box-shadow: 0 10px 20px rgba(0,0,0,0.1); }
        .search-icon { position: absolute; left: 20px; top: 50%; transform: translateY(-50%); color: #1da1f2; }
        .jovem-card { background: white; border-radius: 20px; padding: 15px 20px; margin-bottom: 12px; display: flex; justify-content: space-between; align-items: center; border-left: 6px solid #ddd; transition: 0.3s; }
        .jovem-card.presente { border-left-color: #22c55e; background-color: #f0fdf4; }
        .btn-check-rosa { background: white; color: var(--rosa); border: 2px solid var(--rosa); border-radius: 12px; width: 45px; height: 45px; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; transition: 0.2s; cursor: pointer; }
        .btn-check-rosa.active { background: var(--rosa); color: white; }
        .btn-dots { background: none; border: none; color: #94a3b8; font-size: 1.2rem; padding: 5px 10px; }
        .dropdown-menu { border-radius: 15px; border: none; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

    <div class="header-top"><h2 class="font-chewy m-0">Chamada do Dia</h2></div>
    
    <div class="container" style="max-width: 500px;">
        <div class="search-box">
            <i class="fas fa-search search-icon"></i>
            <input type="text" id="busca" class="form-control search-input" placeholder="Pesquisar..." onkeyup="filtrar()">
        </div>

        <div class="d-flex justify-content-between mb-3 px-2">
            <a href="../index.php" class="btn btn-sm btn-light rounded-pill fw-bold text-muted">Voltar</a>
            <span class="badge bg-white text-primary border rounded-pill py-2 px-3">Total: <span id="total">0</span></span>
        </div>

        <div id="lista">
            <?php
            $sql = "SELECT j.*, (SELECT COUNT(*) FROM presencas p JOIN encontros e ON p.encontro_id = e.id WHERE p.jovem_id = j.id AND e.data_encontro = '$hoje') as ja_veio FROM jovens j ORDER BY j.nome ASC";
            $res = $conn->query($sql);
            while($j = $res->fetch_assoc()): 
                $estaPresente = ($j['ja_veio'] > 0);
            ?>
                <div class="jovem-card shadow-sm <?= $estaPresente ? 'presente' : '' ?>" id="card-<?= $j['id'] ?>" data-nome="<?= strtolower($j['nome']) ?>">
                    <div><h6 class="mb-0 fw-bold" id="n-<?= $j['id'] ?>"><?= $j['nome'] ?></h6></div>
                    <div class="d-flex align-items-center gap-2">
                        <button class="btn-check-rosa <?= $estaPresente ? 'active' : '' ?>" onclick="alternarPresenca(this, <?= $j['id'] ?>)">
                            <i class="fas <?= $estaPresente ? 'fa-check-double' : 'fa-check' ?>"></i>
                        </button>
                        <div class="dropdown">
                            <button class="btn-dots" type="button" data-bs-toggle="dropdown"><i class="fas fa-ellipsis-v"></i></button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><button class="dropdown-item text-primary" onclick="abrEdit(<?= $j['id'] ?>, '<?= $j['nome'] ?>')"><i class="fas fa-edit me-2"></i>Editar</button></li>
                                <li><button class="dropdown-item text-danger" onclick="abrDel(<?= $j['id'] ?>, '<?= $j['nome'] ?>')"><i class="fas fa-trash me-2"></i>Excluir</button></li>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <div class="modal fade" id="mEdit" tabindex="-1"><div class="modal-dialog modal-dialog-centered"><div class="modal-content p-3"><div class="modal-header border-0"><h5 class="modal-title font-chewy">Editar Nome</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div><div class="modal-body"><input type="hidden" id="e-id"><input type="text" id="e-nome" class="form-control form-control-lg rounded-4 bg-light border-0"></div><div class="modal-footer border-0"><button type="button" class="btn btn-primary w-100 rounded-pill py-3 fw-bold" onclick="saveEdit()">Salvar</button></div></div></div></div>
    <div class="modal fade" id="mDel" tabindex="-1"><div class="modal-dialog modal-dialog-centered modal-sm"><div class="modal-content text-center p-3"><div class="modal-body"><h5 class="fw-bold text-danger">Excluir?</h5><p class="text-muted small">Apagar <strong id="d-nome"></strong>?</p><input type="hidden" id="d-id"></div><div class="modal-footer border-0 justify-content-center"><button type="button" class="btn btn-light rounded-pill px-3" data-bs-dismiss="modal">Não</button><button type="button" class="btn btn-danger rounded-pill px-3 fw-bold" onclick="saveDel()">Sim</button></div></div></div></div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const modE = new bootstrap.Modal(document.getElementById('mEdit'));
        const modD = new bootstrap.Modal(document.getElementById('mDel'));
        
        function filtrar(){ 
            let t=document.getElementById('busca').value.toLowerCase(); 
            document.querySelectorAll('.jovem-card').forEach(c=>{ c.style.display=c.getAttribute('data-nome').includes(t)?'flex':'none'; }); 
        }

        async function alternarPresenca(b, id){ 
            let d = new FormData(); d.append('id', id);
            let r = await fetch('../api/marcar_presenca.php', { method: 'POST', body: d });
            let res = await r.json();
            
            if(res.success){
                if(res.action === 'marcado'){
                    b.classList.add('active');
                    b.innerHTML = '<i class="fas fa-check-double"></i>';
                    document.getElementById('card-'+id).classList.add('presente');
                } else {
                    b.classList.remove('active');
                    b.innerHTML = '<i class="fas fa-check"></i>';
                    document.getElementById('card-'+id).classList.remove('presente');
                }
            }
        }

        function abrEdit(id,n){ document.getElementById('e-id').value=id; document.getElementById('e-nome').value=n; modE.show(); }
        async function saveEdit(){ 
            let id=document.getElementById('e-id').value, n=document.getElementById('e-nome').value; 
            let d=new FormData(); d.append('id',id); d.append('nome',n); 
            let r=await fetch('../api/editar_jovem.php',{method:'POST',body:d}); 
            let res=await r.json(); 
            if(res.success){ document.getElementById('n-'+id).innerText=n; modE.hide(); } 
        }

        function abrDel(id,n){ document.getElementById('d-id').value=id; document.getElementById('d-nome').innerText=n; modD.show(); }
        async function saveDel(){ 
            let id=document.getElementById('d-id').value; 
            let d=new FormData(); d.append('id',id); 
            let r=await fetch('../api/excluir_jovem.php',{method:'POST',body:d}); 
            let res=await r.json(); 
            if(res.success){ document.getElementById('card-'+id).remove(); modD.hide(); } 
        }
        document.getElementById('total').innerText = document.querySelectorAll('.jovem-card').length;
    </script>
</body>
</html>