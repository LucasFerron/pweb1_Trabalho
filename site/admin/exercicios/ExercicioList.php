<?php
    include "../db.class.php";

    include_once "../header.php";

        $db = new db('exercicios');

        if(!empty($_GET['id'])){
            $db->destroy($_GET['id']);
        };
        
        if(!empty($_POST)){
            $dados = $db->search($_POST);
        }else{
            $dados = $db->all();
        }

    ?>


                <h3>Listagem Exercicios</h3>
                <!--http://localhost/php/site/admin/PostList.php-->

                <form action="./ExercicioList.php" method="post">

                    <div class="row">
                        <div class="col-md-2">
                            <select name="tipo" class="form-select">
                                <option value="nome">Nome</option>
                                <option value="categoria">Categoria</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <input type="text" name="valor" placeholder="pesquisar..." class="form-control">
                        </div>
                    </div>

                    <div class="row">
                        <div class="col mt-4">
                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                            <a href="./ExercicioForm.php" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="row mt-4">
                <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Equipamento</th>
                        <th scope="col">Nível</th>
                        <th scope="col">Descrição</th>
                        <th scope="col">Ação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbCategoria = new $db('categoria');
                        foreach($dados as $item) {
                            $categoria = $dbCategoria->find($item->categoria_id);
                            echo"
                            <tr>
                                <th scope='row'>$item->id</th>
                                <td>$item->nome</td>
                                <td>$categoria->nome</td>
                                <td>$item->equipamento</td>
                                <td>$item->nivel</td> 
                                <td>$item->descricao</td>
                                <td>
                                    <a class='btn btn-warning' href='./ExercicioForm.php?id=$item->id'><i class='fa-solid fa-pen-to-square'></i></a>
                                </td>
                                <td>
                                    <a class='btn btn-danger'
                                        title='Excluir'
                                        onclick='return confirm(\"Deseja Excluir?\")'
                                        href='./ExercicioList.php?id=$item->id'><i class='fa-solid fa-trash'></i>
                                    </a>
                                </td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
                </table>
            </div>
<?php
    include_once "../footer.php";
?>