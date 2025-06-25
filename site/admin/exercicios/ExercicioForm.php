<?php
    include "../db.class.php";
    include_once "../header.php";

    $db = new db('exercicios');
    $dbCategoria = new db('categoria');
    $categorias = $dbCategoria->all();
    $data = null;
    $errors = [];
    $success = '';

?>

<div class="container mt-4">
    <?php if(!empty($success)) {?>
        <div class="alert alert-success alert-dismissible fade show">
            <strong><?= $success?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <?php if(!empty($errors)) {?>
        <div class="alert alert-danger alert-dismissible fade show">
            <strong>Erro ao salvar:</strong>
            <ul class="mb-0">
                <?php foreach($errors as $error) {?>
                    <?= $error?>
                <?php } ?>
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php } ?>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-info text-white py-3">
            <h4 class="mb-0">Formulário de Exercícios</h4>
        </div>
        
        <div class="card-body">
            <form action="" method="post">
                <input type="hidden" name="id" value="<?= $data->id ?? '' ?>">
                
                <!-- Linha 1 -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="nome" class="form-label fw-bold">Nome do exercício</label>
                        <input type="text" name="nome" class="form-control form-control-lg" 
                               value="<?= $data->nome ?? '' ?>" placeholder="Digite o nome do exercício">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="categoria_id" class="form-label fw-bold">Categoria</label>
                        <select name="categoria_id" class="form-select form-select-lg">
                            <?php foreach($categorias as $categoria) { ?>
                            <option value="<?= $categoria->id ?>"><?= $categoria->nome ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                
                <!-- Linha 2 -->
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="equipamento" class="form-label fw-bold">Equipamento</label>
                        <input type="text" name="equipamento" class="form-control form-control-lg" 
                               value="<?= $data->equipamento ?? '' ?>" placeholder="Equipamentos necessários">
                    </div>
                    
                    <div class="col-md-6">
                        <label for="nivel" class="form-label fw-bold">Nível</label>
                        <select name="nivel" class="form-select form-select-lg">
                            <option value="1">Iniciante</option>
                            <option value="2">Intermediário</option>
                            <option value="3">Avançado</option>
                        </select>
                    </div>
                </div>
                
                <!-- Descrição -->
                <div class="mb-4">
                    <label for="descricao" class="form-label fw-bold">Descrição</label>
                    <textarea name="descricao" class="form-control" rows="4" 
                              placeholder="Descreva o exercício"><?= $data->descricao ?? '' ?></textarea>
                </div>
                
                <!-- Botões -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="./ExercicioList.php" class="btn btn-outline-secondary btn-lg px-4">
                        <i class="fas fa-arrow-left me-2"></i>
                        Voltar
                    </a>
                    <button type="submit" class="btn btn-outline-success btn-lg px-4">
                        <i class="fas <?= !empty($_GET['id']) ? 'fa-sync-alt' : 'fa-save' ?> me-2"></i>
                        <?= !empty($_GET['id']) ? "Atualizar" : "Salvar" ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    include_once "../footer.php";
?>