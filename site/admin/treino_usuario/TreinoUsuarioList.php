<?php
include "../db.class.php";
include_once "../header.php"; 

$db = new db('treino');

// Excluir treino se ID for passado via GET
if (!empty($_GET['id'])) {
    $db->destroy($_GET['id']);
}

// Buscar ou listar todos
$dados = !empty($_POST) ? $db->search($_POST) : $db->all();
?>

<body>
<div class="container mt-5">
    <h3>Lista de Treinos</h3>

    <form action="./TreinoUsuarioList.php" method="post" class="mb-4">
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

            <div class="col-md-4">
                <button type="submit" class="btn btn-primary mt-1">Buscar</button>
                <a href="../treino/TreinoForm.php" class="btn btn-secondary mt-1">Cadastrar</a>
            </div>
        </div>
    </form>

    <div class="accordion" id="accordionTreinos">
        <?php
        $dbUsuario = new db('usuario');
        $contador = 0;

        foreach ($dados as $item) {
            $contador++;
            $usuario = $dbUsuario->find($item->usuario_id);
            $nomeUsuario = $usuario ? $usuario->nome : 'Usuário não encontrado';

            echo "
            <div class='accordion-item'>
                <h2 class='accordion-header' id='heading{$contador}'>
                    <button class='accordion-button collapsed' type='button' data-bs-toggle='collapse'
                        data-bs-target='#collapse{$contador}' aria-expanded='false' aria-controls='collapse{$contador}'>
                        {$item->nome} - {$nomeUsuario}
                    </button>
                </h2>
                <div id='collapse{$contador}' class='accordion-collapse collapse' aria-labelledby='heading{$contador}' data-bs-parent='#accordionTreinos'>
                    <div class='accordion-body'>
                        <p><strong>Descrição:</strong> {$item->descricao}</p>
                        <a href='./TreinoUsuarioForm.php?id={$item->id}' class='btn btn-sm btn-warning'>Editar</a>
                        <a href='./TreinoUsuarioList.php?id={$item->id}' 
                           class='btn btn-sm btn-danger'
                           onclick='return confirm(\"Deseja excluir este treino?\")'>
                           Excluir
                        </a>
                    </div>
                </div>
            </div>
            ";
        }
        ?>
    </div>
</div>

<?php include_once "../footer.php"; ?>
