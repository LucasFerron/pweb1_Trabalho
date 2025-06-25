<?php
    include "../db.class.php";
    include_once "../header.php"; 

    $db = new db('treino');

    if (!empty($_GET['id'])) {
        $db->destroy($_GET['id']);
    }

    if (!empty($_POST)) {
        $dados = $db->search($_POST);
    } else {
        $dados = $db->all();
    }
?>

<body>
    <div class="container mt-5">
        <div class="row">
            <h3>Listagem de Treinos</h3>

            <form action="./TreinoList.php" method="post">
                <div class="row">
                    <div class="col-md-2">
                        <select name="tipo" class="form-select">
                            <option value="nome">Treino</option>
                            <option value="descricao">Descrição</option>
                            <option value="usuario_id">Usuário</option>
                        </select>
                    </div>

                    <div class="col-md-6">
                        <input type="text" name="valor" placeholder="Pesquisar..." class="form-control">
                    </div>
                </div>

                <div class="row">
                    <div class="col mt-4">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i> Buscar</button>
                        <a href="./TreinoForm.php" class="btn btn-secondary"><i class="fa-solid fa-plus"></i> Cadastrar</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Treino</th>
                        <th>Descrição</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbUsuario = new db('usuario');

                        foreach ($dados as $item) {
                            
                            $usuario = $dbUsuario->find($item->usuario_id);
                            $nomeUsuario = $usuario ? $usuario->nome : 'Usuário não encontrado';

                            echo "
                            <tr>
                                <th scope='row'>{$item->id}</th>
                                <td>{$item->nome}</td>
                                <td>{$item->descricao}</td>
                                <td>{$nomeUsuario}</td>
                                <td><a class='btn btn-warning' title='Editar' href='./TreinoForm.php?id={$item->id}'><i class='fa-solid fa-pen-to-square'></i></a></td>
                                <td>
                                    <a class='btn btn-danger' title='Excluir'
                                        onclick='return confirm(\"Deseja excluir este treino?\")' 
                                        href='./TreinoList.php?id={$item->id}'><i class='fa-solid fa-trash'></i></a>
                                </td>
                            </tr>
                            ";
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

<?php include_once "../footer.php"; ?>
