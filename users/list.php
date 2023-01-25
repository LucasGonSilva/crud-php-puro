<?php

include '../connection.php';

$query_users = "SELECT u.id, u.nome, u.email, u.profile_id, p.name AS name_profile 
                FROM users u
                INNER JOIN profiles p
                ON u.profile_id = p.id 
                ORDER BY id DESC";
$result_users = $conn->prepare($query_users);
$result_users->execute();

$dados = "";

while ($row_user = $result_users->fetch(PDO::FETCH_ASSOC)) {
    extract($row_user);
    $dados .= "<tr>
                    <td>$nome</td>
                    <td>$email</td>
                    <td>$name_profile</td>
                    <td>
                        <a href='#' class='icon-acoes' onclick='changeUser($id);'>
                            <img src='assets/img/icon_edit.png' alt=''>
                        </a>
                        <a href='#' class='icon-acoes' data-bs-toggle='modal' data-bs-target='#exampleModal$id'>
                            <img src='assets/img/icon_delete.png' alt=''>
                        </a>
                    </td>
                </tr>";
    $dados .= '<div class="modal fade" id="exampleModal'.$id.'" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Excluir Usuário</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Tem certeza que deseja excluir este usuário? Esta ação não poderá ser revertida!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="button" class="btn btn-danger" onclick="deleteUser('.$id.');">Sim</button>
                        </div>
                    </div>
                </div>
            </div>';
    
}

echo $dados;
