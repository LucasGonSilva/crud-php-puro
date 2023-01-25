<?php

include '../connection.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (!empty($id)) {

    $deleteUser = "DELETE FROM users WHERE id =:id";
    $resultDelete = $conn->prepare($deleteUser);
    $resultDelete->bindParam(':id', $id);

    if($resultDelete->execute()){
        $return = [
            'error' => false,
            'msg' => "<div class='alert alert-success' role='alert'>Usuário removido com sucesso!</div>"
        ];
    } else {
        $return = [
            'error' => true,
            'msg' => "<div class='alert alert-danger' role='alert'>Error: Usuário não apagado com sucesso!</div>"
        ];
    }

} else {
    $return = [
        'error' => true,
        'msg' => "<div class='alert alert-danger' role='alert'>Error: Nenhum usuário encontrado!</div>"
    ];
}

echo json_encode($return);
