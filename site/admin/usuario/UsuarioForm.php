<?php
include "../db.class.php";

include_once "../header.php";

$db = new db('usuario');
$data = null;
$errors = [];
$success = '';

if (!empty($_POST)) {

    
    $data = (object) $_POST;

    
    if (empty(trim($_POST['nome']))) {
        $errors[] = "<li>O nome é obrigatorio</li>";
    }

    if (empty(trim($_POST['email']))) {
        $errors[] = "<li>O email é obrigatorio</li>";
    }

    if (empty(trim($_POST['cpf']))) {
        $errors[] = "<li>O cpf é obrigatorio</li>";
    }

    if (empty(trim($_POST['telefone']))) {
        $errors[] = "<li>O telefone é obrigatorio</li>";
    }

    if (empty(trim($_POST['senha']))) {
        $errors[] = "<li>O senha é obrigatorio</li>";
    }

    if (empty(trim($_POST['cargo']))) {
        $errors[] = "<li>O cargo é obrigatorio</li>";
    }

    if (empty($errors)) {
        try {
            if ($_POST['senha'] === $_POST['c_senha']) {

                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                unset($_POST['c_senha']);

                if (!empty($_POST['id'])) {
                    $db->update($_POST, $_POST['id']);
                    $success = "Usuário atualizado com sucesso!";
                } else {
                    $db->store($_POST);
                    $success = "Registro criado com sucesso!";
                }

                echo "<script>
                    setTimeout(() => window.location.href = './UsuarioList.php', 1500);
                </script>";

            } else {
                $errors[] = "<li>As senhas não coincidem. Tente novamente</li>";
            }
        } catch (Exception $e) {
            $errors[] = $e->getMessage();
        }
    }

}

if (!empty($_GET['id'])) {
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
            <h4 class="mb-0"><i class="fas fa-user-edit me-2"></i>Formulário de Usuário</h4>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="nome" class="form-label fw-bold">Nome Completo</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                            <input type="text" name="nome" id="nome" class="form-control form-control-lg" 
                                   value="<?= $data->nome ?? '' ?>" placeholder="Digite o nome completo do aluno">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="telefone" class="form-label fw-bold">Telefone</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-phone"></i></span>
                            <input type="text" name="telefone" id="telefone" class="form-control form-control-lg" 
                                   value="<?= $data->telefone ?? '' ?>" placeholder="(00) 00000-0000">
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-bold">Email</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            <input type="email" name="email" id="email" class="form-control form-control-lg" 
                                   value="<?= $data->email ?? '' ?>" placeholder="seu@email.com">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="cpf" class="form-label fw-bold">CPF</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-id-card"></i></span>
                            <input type="text" name="cpf" id="cpf" class="form-control form-control-lg" 
                                   value="<?= $data->cpf ?? '' ?>" placeholder="000.000.000-00">
                        </div>
                    </div>
                </div>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="senha" class="form-label fw-bold">Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="senha" id="senha" class="form-control form-control-lg" 
                                   placeholder="Digite sua senha">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <label for="c_senha" class="form-label fw-bold">Confirmar Senha</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            <input type="password" name="c_senha" id="c_senha" class="form-control form-control-lg" 
                                   placeholder="Confirme sua senha">
                        </div>
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="cargo" class="form-label fw-bold">Cargo</label>
                        <select name="cargo" class="form-select form-select-lg">
                            <option value="professor">Professor</option>
                            <option value="aluno">Aluno</option>
                        </select>
                    </div>
                </div>
                
                <div class="d-flex justify-content-between mt-4">
                    <a href="./UsuarioList.php" class="btn btn-outline-secondary btn-lg px-4">
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

<?php
    include_once "../footer.php";
?>