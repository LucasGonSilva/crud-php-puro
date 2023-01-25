<?php

include '../connection.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $query_usuario = "SELECT id, nome, email, profile_id FROM users WHERE id = :id LIMIT 1";
    $resultado = $conn->prepare($query_usuario);
    $resultado->bindParam(':id', $id);
    $resultado->execute();

    $dados = $resultado->fetch(PDO::FETCH_ASSOC);

    $return = [
        'error' => false,
        'dados' => $dados
    ];

} else {
    echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Nenhum usuário encontrado!</div>"
    ];
}

echo json_encode($return);
