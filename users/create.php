<?php

include_once "../connection.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


if (empty($dados['txtName'])) {
    $retorna = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo nome!</div>"
    ];
} elseif (empty($dados['txtEmail'])) {
    $retorna = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo email!</div>"
    ];
} else {
    var_dump($dados);
    
    $dateAtual = date("Y-m-d H:i:s");

    $passwordHash = password_hash('123456', PASSWORD_DEFAULT);

    $query_usuario = "INSERT INTO users (nome, email, password, profile_id) VALUES (:nome, :email, :password, :profile_id)";
    $cadUsuario = $conn->prepare($query_usuario);
    
    $cadUsuario->bindParam(":nome", $dados['txtName'], PDO::PARAM_STR);
    $cadUsuario->bindParam(':email', $dados['txtEmail'], PDO::PARAM_STR);
    $cadUsuario->bindParam(':password', $passwordHash, PDO::PARAM_STR);
    $cadUsuario->bindParam(':profile_id', $dados['cmbPerfil']);

    try {

        $cadUsuario->execute();

    } catch( PDOException $e ) {

        var_dump($e);
    }

    if ($cadUsuario->rowCount()) {
        $retorna = [
            'error' => false,
            'msg' => "<div class='alert alert-success' role='alert'>Usuário cadastrado com sucesso!</div>"
        ];
    } else {
        $retorna = [
            'error' => true,
            'msg' => "<div class='alert alert-danger' role='alert'>Error: Usuário não cadastrado com sucesso!</div>"
        ];
    }
}

echo json_encode($retorna);
