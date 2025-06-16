<?php
    include "../db.class.php";

    include_once "../header.php";


    $db = new db('treino');
    $dbUsuario = new db('usuario');
    $usuario = $dbUsuario->all();
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
                            ()=> window.location.href = 'home.php', 1000
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

                <h3>Formulário Treinos</h3>
                <!--http://localhost/php/site/admin/TreinoForm.php-->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Nome</label>
                            <input type="text" name="nome" value="<?php echo $data->nome ?? '' ?>" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label for="" class="form-label">Descrição</label>
                            <input type="text" name="descricao" value="<?= $data->descricao ?? '' ?>" class="form-control">
                        </div>
                    </div>

                    <div class="col-md-6">
                            <label for="" class="form-label">Usuario</label>
                            <select name="usuario_id" class="select-control">
                                <?php
                                foreach($usuario as $usuario) {
                                ?>
                                    <option value="<?= $usuario->id ?>">
                                        <?= $usuario->nome ?>
                                    </option>
                                <?php
                                }   
                                ?>
                            </select>
                        </div>

                    <div class="row">
                        <div class="col mt-4">
                            <button type="submit" class="btn btn-primary">
                                Salvar
                            </button>
                            <a href="./TreinoUsuarioList.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </form>

    <?php
    
    include_once "../footer.php";
    
    ?>