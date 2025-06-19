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
$isEdit = false;

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
            if ($isEdit) {
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

<div class="container mt-5">
    <!--Sucesso-->
    <?php if(!empty($success)) { ?>
        <div class="alert alert-success">
            <strong><?= $success ?></strong>
        </div>
    <?php } ?>

    <!--Erro-->
    <?php if(!empty($errors)) { ?>
        <div class="alert alert-danger">
            <strong>Erro ao salvar:</strong>
            <ul class="mb-0">
                <?php foreach($errors as $error) { ?>
                    <?= $error ?>
                <?php } ?>
            </ul>
        </div>
    <?php } ?>

    <h3><?= $isEdit ? 'Editar' : 'Adicionar' ?> Exercício no Treino</h3>
    
    <form action="" method="post">
        <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Treino</label>
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

            <div class="col-md-6">
                <label class="form-label">Exercício</label>
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

        <div class="row mb-3">
            <div class="col-md-4">
                <label class="form-label">Séries</label>
                <input type="number" name="series" class="form-control" 
                    value="<?= $data->series ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Repetições</label>
                <input type="number" name="repeticoes" class="form-control" 
                    value="<?= $data->repeticoes ?? '' ?>" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Carga (kg)</label>
                <input type="number" name="carga" class="form-control" 
                    value="<?= $data->carga ?? '' ?>">
            </div>
        </div>

        <div class="row">
            <div class="col mt-4">
                <button type="submit" class="btn btn-primary">Salvar</button>
                <a href="../treino_usuario/TreinoUsuarioList.php" class="btn btn-secondary">Voltar</a>
            </div>
        </div>
    </form>
</div>

<?php include_once "../footer.php"; ?>