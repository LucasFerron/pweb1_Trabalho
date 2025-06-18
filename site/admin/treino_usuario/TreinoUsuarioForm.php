<?php
    include "../db.class.php";

    include_once "../header.php";


    $dbTreino = new db('treino');
    $treino = $dbTreino->all();
    $dbExercicio = new db('exercicios');
    $exercicio = $dbExercicio->all();
    $dbUsuario = new db('usuario');
    $usuarios = $dbUsuario->all();
    $usuariosMap = [];
    foreach ($usuarios as $usuario) {
        $usuariosMap[$usuario->id] = $usuario->nome;
    }
    $db = new db('treino_exercicios');
    $data = null;
    $errors = [];
    $success = '';

        if(!empty($_POST)){

            $data = (object) $_POST;

            if(empty(trim($_POST['treino_id']))){
                $errors[] = "<li>O Treino é Obrigatório.</li>";
            }
            if(empty(trim($_POST['exercicios_id']))){
                $errors[] = "<li>O Exercício é Obrigatório.</li>";
            }
            if(empty(trim($_POST['series']))){
                $errors[] = "<li>A quantidade de séries é Obrigatório.</li>";
            }
            if(empty(trim($_POST['repeticoes']))){
                $errors[] = "<li>A quantidade de repetições é Obrigatório.</li>";
            }


            if (empty(($errors))){
                try {
                    
                    $db->store($_POST);
                    $success = "Registro criado com sucesso!";
                    
                    echo "<script>
                        setTimeout(
                            ()=> window.location.href = './TreinoUsuarioList.php', 1000
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

                <h3>Formulário Treinos por Usuário</h3>
                <!--http://localhost/php/site/admin/TreinoForm.php-->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">

                    <div class="col-md-6">
                        <label for="" class="form-label">Treino</label>
                        <select name="treino_id" class="select-control">
                            <?php
                                foreach($treino as $treino) {
                            ?>

                            <option value="<?= $treino->id ?>">
                                <?= $treino->nome ?> - <?= $usuariosMap[$treino->usuario_id] ?? 'Usuário desconhecido' ?>
                            </option>
                            <?php
                                }   
                            ?>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="" class="form-label">Exercício</label>
                        <select name="exercicios_id" class="select-control">
                            <?php
                                foreach($exercicio as $exercicio) {
                            ?>

                            <option value="<?= $exercicio->id ?>">
                                <?= $exercicio->nome ?>
                            </option>
                            <?php
                                }   
                            ?>
                        </select>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <label for="" class="form-label">Séries</label>
                            <input type="number" name="series" value="<?php echo $data->nome ?? '' ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Repetições</label>
                            <input type="number" name="repeticoes" value="<?= $data->descricao ?? '' ?>" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label for="" class="form-label">Carga</label>
                            <input type="number" name="carga" value="<?php echo $data->nome ?? '' ?>" class="form-control">
                        </div>
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