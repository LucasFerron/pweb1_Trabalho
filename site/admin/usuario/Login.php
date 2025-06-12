<?php
    include "../db.class.php";

    include_once "../header.php";


    $db = new db('usuario');
    $data = null;
    $errors = [];
    $success = '';

        if(!empty($_POST)){

            $data = (object) $_POST;

            if(empty(trim($_POST['nome']))){
                $errors[] = "<li>O nome é Obrigatório.</li>";
            }
            if(empty(trim($_POST['email']))){
                $errors[] = "<li>O email é Obrigatório.</li>";
            }
            if(empty(trim($_POST['cpf']))){
                $errors[] = "<li>O cpf é Obrigatório.</li>";
            }
            if(empty(trim($_POST['telefone']))){
                $errors[] = "<li>O telefone é Obrigatório.</li>";
            }
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

        /*
        function getValue($field, $data = null){
            if($data && isset($data->$field)){
                return
            }
        }
        */
        //var_dump($data);

    ?>


                
                <!--Sucesso-->
                <?php if(!empty($success)) {?>
                    <div class="alert alert-success">
                        <strong>
                            <?= $success?>
                        </strong>
                    </div>
                <?php } ?>

                <!--Erro-->
                <?php if(!empty($errors)) {?>
                    <div class="alert alert-danger">
                        <strong>Erro ao salvar:</strong>
                        <ul class="mb-0">
                            <?php foreach($errors as $error) {?>
                                <?= $error?>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>

                <h3>Login</h3>
                <!--http://localhost/php/site/admin/UsuarioForm.php-->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" name="nome" value="<?php echo $data->nome ?? '' ?>" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Telefone</label>
                            <input type="text" name="telefone" value="<?= $data->telefone ?? '' ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Email</label>
                            <input type="email" name="email" value="<?= $data->email ?? '' ?>" class="form-control">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="form-label">CPF</label>
                            <input type="text" name="cpf" value="<?= $data->cpf ?? '' ?>" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Login</label>
                            <input type="text" name="login" value="<?= $data->login ?? '' ?>" class="form-control">
                        </div>
                        
                        <div class="col-md-4">
                            <label for="" class="form-label">Senha</label>
                            <input type="password" name="senha" value="<?= $data->senha ?? '' ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Confirmar Senha</label>
                            <input type="password" name="c_senha" class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mt-4">
                            <button type="submit" class="btn btn-primary">
                                Salvar
                            </button>
                            <a href="./login.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </form>

    <?php
    
    include_once "../footer.php";
    
    ?>