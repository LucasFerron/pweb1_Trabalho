<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: ./index.php"); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <title>Painel de Administração</title>
    <style>
        
        .dashboard-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white py-3">
                <h2 class="mb-0"><i class="fas fa-tachometer-alt me-2"></i>Painel de Administração</h2>
            </div>
            
            <div class="card-body">
                <p class="lead mb-4">Bem-vindo ao Sistema de Gerenciamento de Treinos</p>
                
                <div class="row g-4">
                    
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-users fa-3x text-success mb-3"></i>
                                <h5 class="card-title">Gerenciar Usuários</h5>
                                <p class="card-text">Cadastre e edite alunos e treinadores</p>
                                <a href="./usuario/UsuarioList.php" class="btn btn-success btn-lg w-100">
                                    <i class="fas fa-user-cog me-2"></i> Acessar
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-dumbbell fa-3x text-primary mb-3"></i>
                                <h5 class="card-title">Gerenciar Exercícios</h5>
                                <p class="card-text">Cadastre e edite os exercícios disponíveis</p>
                                <a href="./exercicios/ExercicioList.php" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-running me-2"></i> Acessar
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-md-4">
                        <div class="card dashboard-card h-100">
                            <div class="card-body text-center">
                                <i class="fas fa-clipboard-list fa-3x text-warning mb-3"></i>
                                <h5 class="card-title">Gerenciar Treinos</h5>
                                <p class="card-text">Monte e edite treinos para os alunos</p>
                                <a href="./treino_usuario/TreinoUsuarioList.php" class="btn btn-warning btn-lg w-100">
                                    <i class="fas fa-calendar-alt me-2"></i> Acessar
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once "./footer.php"; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous"></script>
</body>
</html>