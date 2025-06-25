<?php
    include "../db.class.php";
    include_once "../header.php";

    $db = new db('treino');
    $dbUsuario = new db('usuario');
    $listaUsuarios = $dbUsuario->all();
    $data = null;
    $errors = [];
    $success = '';

    if(!empty($_POST)){
        $data = (object) $_POST;

        if(empty(trim($_POST['nome']))){
            $errors[] = "<li>O nome é Obrigatório.</li>";
        }
        if(empty(trim($_POST['descricao']))){
            $errors[] = "<li>A descrição é Obrigatória.</li>";
        }
        if(empty(trim($_POST['usuario_id']))){
            $errors[] = "<li>O usuário é Obrigatório.</li>";
        }

        if (empty(($errors))){
            try {
                $db->store($_POST);
                $success = "Registro criado com sucesso!";
                
                echo "<script>
                    setTimeout(
                        ()=> window.location.href = '../treino_usuario/TreinoUsuarioForm.php', 1000
                    )
                </script>";
            } catch(Exception $e){
                $errors[] = "Erro ao salvar: " . $e->getMessage();
            }
        }
    }

    if(!empty($_GET['id'])){
        $data = $db->find($_GET['id']);
    }
?>

<div class="container mt-4">

    <?php if(!empty($success)) { ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="fas fa-check-circle me-2"></i>
            <strong><?= $success ?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if(!empty($errors)) { ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <i class="fas fa-exclamation-triangle me-2"></i>
            <strong>Erro ao salvar:</strong>
            <ul class="mb-0">
                <?php foreach($errors as $error) { ?>
                    <li><?= $error ?></li>
                <?php } ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="card shadow-sm">
        <div class="card-header bg-info text-white py-3">
            <h4 class="mb-0"><i class="fas fa-dumbbell me-2"></i>Formulário de Treinos</h4>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="nome" class="form-label fw-bold">Nome do Treino</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg" 
                                   value="<?= $data->nome ?? '' ?>" placeholder="Ex: Treino de Força">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="descricao" class="form-label fw-bold">Descrição</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-align-left"></i></span>
                            <input type="text" name="descricao" id="descricao" class="form-control form-control-lg" 
                                   value="<?= $data->descricao ?? '' ?>" placeholder="Descrição do treino">
                        </div>
                    </div>
                </div>
                
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="usuario_id" class="form-label fw-bold">Aluno</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <select name="usuario_id" id="usuario_id" class="form-select form-select-lg">
                                <option value="">Selecione um aluno</option>
                                <?php foreach($listaUsuarios as $usuario) { ?>
                                    <option value="<?= $usuario->id ?>" <?= (isset($data->usuario_id) && $data->usuario_id == $usuario->id) ? 'selected' : '' ?>>
                                        <?= $usuario->nome ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-between mt-4">
                    <div>
                        <a href="./TreinoList.php" class="btn btn-outline-secondary btn-lg px-4 me-2">
                            <i class="fas fa-arrow-left me-2"></i> Voltar
                        </a>
                        <a href="../treino_usuario/TreinoUsuarioForm.php" class="btn btn-outline-primary btn-lg px-4">
                            <i class="fas fa-plus-circle me-2"></i> Cadastrar Exercício
                        </a>
                    </div>
                    <button type="submit" class="btn btn-success btn-lg px-4">
                        <i class="fas fa-save me-2"></i> Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_once "../footer.php";
?>