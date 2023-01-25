<?php

include_once "../connection.php";

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (empty($dados['id'])) {
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Tente mais tarde!</div>"
    ];
} elseif (empty($dados['nome'])) {
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo nome!</div>"
    ];
} elseif (empty($dados['email'])) {
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo email!</div>"
    ];
} elseif (empty($dados['profile'])) {
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Necessário selecionar um perfil!</div>"
    ];
} else {
    $query_usuario = "UPDATE users SET nome = :nome, email = :email, profile_id = :profile_id WHERE id = :id";
    $editUsuario = $conn->prepare($query_usuario);
    $editUsuario->bindParam(':nome', $dados['nome']);
    $editUsuario->bindParam(':email', $dados['email']);
    $editUsuario->bindParam(':profile_id', $dados['profile']);
    $editUsuario->bindParam(':id', $dados['id']);

    if ($editUsuario->execute()) {
        $return = [
            'error' => false,
            'msg' => "<div class='alert alert-success' role='alert'>Usuário alterado com sucesso!</div>"
        ];
    } else {
        $return = [
            'error' => true,
            'msg' => "<div class='alert alert-danger' role='alert'>Error: Usuário não alterado com sucesso!</div>"
        ];
    }
}

echo json_encode($return);
