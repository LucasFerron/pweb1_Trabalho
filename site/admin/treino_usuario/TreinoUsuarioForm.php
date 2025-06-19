<?php
include "../db.class.php";
include_once "../header.php";

$dbTreinoEx = new db('treino_exercicios');

$success = '';
$errors = [];
$exercicio = null;

if (!empty($_GET['id_exercicio'])) {
    $exercicio = $dbTreinoEx->find($_GET['id_exercicio']);

    if (!$exercicio) {
        $errors[] = "Exercício não encontrado.";
    }
}

// Se o formulário foi enviado
if (!empty($_POST)) {
    $id = $_POST['id'];
    $series = $_POST['series'];
    $repeticoes = $_POST['repeticoes'];
    $carga = $_POST['carga'];

    if (empty($series) || empty($repeticoes) || empty($carga)) {
        $errors[] = "Todos os campos são obrigatórios.";
    } else {
        $dbTreinoEx->update($id, [
            'series' => $series,
            'repeticoes' => $repeticoes,
            'carga' => $carga
        ]);

        $success = "Exercício atualizado com sucesso!";
        $exercicio = $dbTreinoEx->find($id);
        echo "<script>
            setTimeout(
                ()=> window.location.href = '../treino_usuario/TreinoUsuarioList.php', 1000
            )
        </script>";
    }
}
?>

<div class="container mt-5">
    <h3>Editar Exercício do Treino</h3>

    <?php if ($success): ?>
        <div class="alert alert-success"><?= $success ?></div>
    <?php endif; ?>

    <?php if (!empty($errors)): ?>
        <div class="alert alert-danger">
            <ul>
                <?php foreach ($errors as $e): ?>
                    <li><?= $e ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <?php if ($exercicio): ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?= $exercicio->id ?>">

            <div class="mb-3">
                <label class="form-label">Séries</label>
                <input type="number" name="series" class="form-control" value="<?= $exercicio->series ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Repetições</label>
                <input type="number" name="repeticoes" class="form-control" value="<?= $exercicio->repeticoes ?>" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Carga (kg)</label>
                <input type="number" name="carga" class="form-control" value="<?= $exercicio->carga ?>" required>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
            <a href="../treino_usuario/TreinoUsuarioList.php" class="btn btn-secondary">Voltar</a>
        </form>
    <?php endif; ?>
</div>

<?php include_once "../footer.php"; ?>
