<!DOCTYPE html>
<html lang="pt">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
        <title>Formulario de Usuário</title>
    </head>

    <body class="mt-5 ms-4">
    
<div class="col">
    <h2>Bem vindo a página de Admin do Sistema de Treinos</h2>

    <a href="./usuario/UsuarioList.php" class="btn btn-success">Usuário</a>
    <a href="./exercicios/ExercicioList.php" class="btn btn-primary">Exercícios</a>
    <a href="./treino/TreinoForm.php" class="btn btn-primary">Treinos</a>

</div>

<?php
include_once "./footer.php";   
?>