<?php
    include "../db.class.php";
    include_once "../header.php"; 

    $db = new db('treino');

    // Excluir treino se ID for passado via GET
    if (!empty($_GET['id'])) {
        $db->destroy($_GET['id']);
    }

    // Buscar ou listar todos
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
                            <option value="nome">Nome</option>
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
                        <button type="submit" class="btn btn-primary">Buscar</button>
                        <a href="./TreinoForm.php" class="btn btn-secondary">Cadastrar</a>
                    </div>
                </div>
            </form>
        </div>

        <div class="row mt-4">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Usuário</th>
                        <th>Ações</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $dbUsuario = new db('usuario'); // conexão com tabela de usuários

                        foreach ($dados as $item) {
                            // Buscar o usuário pelo ID
                            $usuario = $dbUsuario->find($item->usuario_id);
                            $nomeUsuario = $usuario ? $usuario->nome : 'Usuário não encontrado';

                            echo "
                            <tr>
                                <th scope='row'>{$item->id}</th>
                                <td>{$item->nome}</td>
                                <td>{$item->descricao}</td>
                                <td>{$nomeUsuario}</td>
                                <td><a href='./TreinoForm.php?id={$item->id}'>Editar</a></td>
                                <td>
                                    <a 
                                        onclick='return confirm(\"Deseja excluir este treino?\")' 
                                        href='./TreinoList.php?id={$item->id}'>Excluir</a>
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
