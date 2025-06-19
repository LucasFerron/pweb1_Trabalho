<?php
include "../db.class.php";
include_once "../header.php";

// Inicializa todas as conexões necessárias
$dbTreino = new db('treino');
$dbExercicio = new db('exercicios');
$dbUsuario = new db('usuario');
$dbTreinoEx = new db('treino_exercicios');

// Carrega dados para os selects
$treinos = $dbTreino->all();
$exercicios = $dbExercicio->all();
$usuarios = $dbUsuario->all();

// Mapeia usuários para exibição
$usuariosMap = [];
foreach ($usuarios as $usuario) {
    $usuariosMap[$usuario->id] = $usuario->nome;
}

$data = null;
$errors = [];
$success = '';
$isEdit = false; // Definindo valor padrão para evitar o warning

// Verifica se é edição
if (!empty($_GET['id_exercicio'])) {
    $data = $dbTreinoEx->find($_GET['id_exercicio']);
    $isEdit = true;
    
    if (!$data) {
        $errors[] = "Exercício do treino não encontrado.";
    }
}

// Processa o formulário
if (!empty($_POST)) {
    $data = (object) $_POST;
    
    // Validações
    if (empty(trim($_POST['treino_id']))) {
        $errors[] = "<li>O Treino é Obrigatório.</li>";
    }
    if (empty(trim($_POST['exercicios_id']))) {
        $errors[] = "<li>O Exercício é Obrigatório.</li>";
    }
    if (empty(trim($_POST['series']))) {
        $errors[] = "<li>A quantidade de séries é Obrigatória.</li>";
    }
    if (empty(trim($_POST['repeticoes']))) {
        $errors[] = "<li>A quantidade de repetições é Obrigatória.</li>";
    }

    if (empty($errors)) {
        try {
            if ($isEdit && !empty($_POST['id'])) {
                // Modo edição
                $dbTreinoEx->update($_POST['id'], [
                    'treino_id' => $_POST['treino_id'],
                    'exercicios_id' => $_POST['exercicios_id'],
                    'series' => $_POST['series'],
                    'repeticoes' => $_POST['repeticoes'],
                    'carga' => $_POST['carga']
                ]);
                $success = "Exercício do treino atualizado com sucesso!";
            } else {
                // Modo criação
                $dbTreinoEx->store($_POST);
                $success = "Exercício adicionado ao treino com sucesso!";
            }
            
            echo "<script>
                setTimeout(() => window.location.href = '../treino_usuario/TreinoUsuarioList.php', 1000)
            </script>";
            
        } catch(Exception $e) {
            $errors[] = "Erro ao salvar: " . $e->getMessage();
        }
    }
}
?>

<div class="container mt-4">
    <!-- Alertas -->
    <?php if(!empty($success)) { ?>
        <div class="alert alert-success alert-dismissible fade show mb-4">
            <i class="fas fa-check-circle me-2"></i>
            <strong><?= $success ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if(!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erro ao salvar:</strong>
            <ul class="mb-0 ps-3">
                <?php foreach($errors as $error) { ?>
                    <li><?= $error ?></li>
                <?php } ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white py-3">
            <h5 class="mb-0"><i class="fas fa-dumbbell me-2"></i><?= $isEdit ? 'Editar' : 'Adicionar' ?> Exercício no Treino</h5>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                <!-- Linha 1: Treino e Exercício -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label class="form-label fw-bold">Treino</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-running"></i></span>
                            <select name="treino_id" class="form-select" required>
                                <option value="">Selecione um treino</option>
                                <?php foreach($treinos as $treino) { ?>
                                    <option value="<?= $treino->id ?>" 
                                        <?= isset($data->treino_id) && $data->treino_id == $treino->id ? 'selected' : '' ?>>
                                        <?= $treino->nome ?> - <?= $usuariosMap[$treino->usuario_id] ?? 'Usuário desconhecido' ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-bold">Exercício</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-dumbbell"></i></span>
                            <select name="exercicios_id" class="form-select" required>
                                <option value="">Selecione um exercício</option>
                                <?php foreach($exercicios as $exercicio) { ?>
                                    <option value="<?= $exercicio->id ?>" 
                                        <?= isset($data->exercicios_id) && $data->exercicios_id == $exercicio->id ? 'selected' : '' ?>>
                                        <?= $exercicio->nome ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Linha 2: Detalhes do exercício -->
                <div class="row g-3 mb-4">
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Séries</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-list-ol"></i></span>
                            <input type="number" name="series" class="form-control" 
                                value="<?= $data->series ?? '' ?>" min="1" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Repetições</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-redo"></i></span>
                            <input type="number" name="repeticoes" class="form-control" 
                                value="<?= $data->repeticoes ?? '' ?>" min="1" required>
                        </div>
                    </div>
                    
                    <div class="col-md-4">
                        <label class="form-label fw-bold">Carga (kg)</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-weight-hanging"></i></span>
                            <input type="number" name="carga" class="form-control" 
                                value="<?= $data->carga ?? '' ?>" min="0" step="0.5">
                        </div>
                    </div>
                </div>

                <!-- Botões -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="../treino_usuario/TreinoUsuarioList.php" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-arrow-left me-2"></i> Voltar
                    </a>
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-save me-2"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include_once "../footer.php"; ?>