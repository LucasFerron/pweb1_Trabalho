<?php
include "../db.class.php";
include_once "../header.php";

$db = new db('usuario');
$data = null;
$errors = [];
$success = '';

if(!empty($_POST)){
    $data = (object) $_POST;

    if(empty(trim($_POST['login']))){
        $errors[] = "<li>O login é Obrigatório.</li>";
    }
    if(empty(trim($_POST['senha']))){
        $errors[] = "<li>A senha é Obrigatória.</li>";
    }

    if (empty(($errors))){
        try {
            if($_POST['senha'] === $_POST['c_senha']){
                $_POST['senha'] = password_hash($_POST['senha'], PASSWORD_BCRYPT);
                unset($_POST['c_senha']);

                $db->store($_POST);
                $success = "Registro criado com sucesso!";
            
                echo "<script>
                    setTimeout(
                        ()=> window.location.href = 'home.php', 1000
                    )
                </script>";
            } else {
                $errors[] = "<li>As senhas não conferem. Tente novamente.</li>";
            }
        } catch(Exception $e){
            $errors[] = "Erro ao salvar: " . $e->getMessage();
        }
    }
}

if(!empty($_GET['id'])){
    $data = $db->find($_GET['id']);
}
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow">
                <div class="card-header bg-info text-white text-center">
                    <h4 class="my-2">Acesso do Treinador</h4>
                </div>
                
                <div class="card-body p-4">
                    <!--Sucesso-->
                    <?php if(!empty($success)) {?>
                        <div class="alert alert-success alert-dismissible fade show">
                            <strong><?= $success?></strong>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <!--Erro-->
                    <?php if(!empty($errors)) {?>
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Erro ao acessar:</strong>
                            <ul class="mb-0">
                                <?php foreach($errors as $error) {?>
                                    <?= $error?>
                                <?php } ?>
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php } ?>

                    <div class="text-center mb-4">
                        <i class="bi bi-person-lock fs-1 text-primary"></i>
                    </div>

                    <form action="" method="post">
                        <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                        <div class="mb-3">
                            <label for="login" class="form-label">Login</label>
                            <input type="text" name="login" id="login" value="<?= $data->login ?? '' ?>" 
                                   class="form-control" placeholder="Digite seu login" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="senha" class="form-label">Senha</label>
                            <input type="password" name="senha" id="senha" value="<?= $data->senha ?? '' ?>" 
                                   class="form-control" placeholder="Digite sua senha" required>
                        </div>

                        <div class="d-grid mb-3">
                            <button type="submit" class="btn btn-success btn-lg">
                                <i class="bi bi-box-arrow-in-right me-2"></i>
                                Entrar
                            </button>
                        </div>

                        <div class="text-center">
                            <small>Não possui login? <a href="cadastro.php" class="text-info">Cadastre-se</a></small>
                        </div>
                    </form>
                </div>
                
                <div class="card-footer text-center bg-light">
                    <small class="text-muted">Sistema de Gerenciamento de Treinos</small>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include_once "../footer.php";
?>