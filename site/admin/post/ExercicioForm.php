<?php
    include "../db.class.php";
    include_once "../header.php";

    $db = new db('exercicios');
    $dbCategoria = new db('categoria');
    $categorias = $dbCategoria->all();
    $data = null;
    $errors = [];
    $success = '';

        if(!empty($_POST)){

            $data = (object) $_POST;

            if(empty(trim($_POST['titulo']))){
                $errors[] = "<li>O titulo é Obrigatório.</li>";
            }
            if(empty(trim($_POST['descricao']))){
                $errors[] = "<li>A descricao é Obrigatória.</li>";
            }
            if(empty(trim($_POST['categoria_id']))){
                $errors[] = "<li>A categoria é Obrigatória.</li>";
            }


            if (empty(($errors))){
                try {
                    if(empty($_POST['id'])){
                        $db->store($_POST);
                        $success = "Registro criado com sucesso!";
                    } else {
                        $db->update($_POST);
                        $success = "Registro atualizado com sucesso!";
                    }
                    echo "<script>
                        setTimeout(
                            ()=> window.location.href = 'ExercicioList.php', 1000
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

                <h3>Formulário Exercícios</h3>
                <!--http://localhost/php/site/admin/UsuarioForm.php-->
                <form action="" method="post">
                    <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Titulo</label>
                            <input type="text" name="titulo" value="<?php echo $data->titulo ?? '' ?>" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label for="" class="form-label">Categoria</label>
                            <select name="categoria_id" class="select-control">
                                <?php
                                foreach($categorias as $categoria) {
                                ?>
                                    <option value="<?= $categoria->id ?>">
                                        <?= $categoria->nome ?>
                                    </option>
                                <?php
                                }   
                                ?>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label for="" class="form-label">Data de Publicação</label>
                            <input type="date" name="data_publicacao" value="<?= $data->data_publicacao ?? '' ?>" class="form-control">
                        </div>
                        
                        <div class="col-md-6">
                            <label for="" class="form-label">Status</label>
                            <select name="status" class="select-control">
                                <option value="publicado">Publicado</option>
                                <option value="nao_publicado">Não Publicado</option>
                            </select>
                        </div>  
                    </div>
                    <div class="col-md-12">
                        <label for="" class="form-label">Descrição</label>
                        <textarea name="descricao" class="form-control" value="<?= $data->descricao ?? '' ?>"></textarea>
                    </div>

                    <div class="row">
                        <div class="col mt-4">
                            <button type="submit" class="btn btn-primary">
                                <?= !empty($_GET['id']) ? "Editar" : "Salvar"?>
                            </button>
                            <a href="./ExercicioList.php" class="btn btn-secondary">Voltar</a>
                        </div>
                    </div>
                </form>
            </div>

<?php
    include_once "../footer.php";
?>