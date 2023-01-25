<?php
session_start();
ob_start();
include 'connection.php';

$key = filter_input(INPUT_GET, 'key', FILTER_DEFAULT);

if (!empty($key)) {
    $searchUser = "SELECT id FROM users WHERE hash_user_recover = :hash_user_recover LIMIT 1";
    $resultSearch = $conn->prepare($searchUser);
    $resultSearch->bindParam(':hash_user_recover', $key, PDO::PARAM_STR);
    $resultSearch->execute();

    if (($resultSearch) and $resultSearch->rowCount() != 0) {
        $row_user = $resultSearch->fetch(PDO::FETCH_ASSOC);
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (!empty($dados['sendUpdatePassword'])) {
            $passwordHash = password_hash($dados['txtSenha'], PASSWORD_DEFAULT);
            $hashUserRecoverNull = NULL;
            $updateUser = "UPDATE users SET password = :password, hash_user_recover =:hash_user_recover  WHERE id = :id LIMIT 1";
            $resultUpdateUser = $conn->prepare($updateUser);
            $resultUpdateUser->bindParam(':password', $passwordHash, PDO::PARAM_STR);
            $resultUpdateUser->bindParam(':hash_user_recover', $hashUserRecoverNull);
            $resultUpdateUser->bindParam(':id', $row_user['id'], PDO::PARAM_INT);

            if ($resultUpdateUser->execute()) {
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                    Senha atualizada com sucesso!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                header("Location: index.php");
            }
        }
    } else {
        $_SESSION['msg_rec'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error: Link inválido, solicite novo link para atualizar sua senha!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
        header("Location: recover_password.php");
    }
} else {
    $_SESSION['msg_rec'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error: Link inválido, solicite novo link para atualizar sua senha!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    header("Location: recover_password.php");
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="assets/css/signin.css" rel="stylesheet">
    <title>Atualizar Senha - SIB - Sistema Integrado de Beneficios</title>
</head>

<body>
    <div class="container">
        <main class="form-signin">

            <form method="POST" action="">
                <div class="text-center">
                    <img class="mb-5" src="assets/img/logo_sib.png" alt="" width="250" height="115">
                </div>
                
                <div class="mt-3 mb-3">
                    <label for="txtSenha" class="form-label">Senha</label>
                    <input type="password" name="txtSenha" class="form-control" id="txtSenha" aria-describedby="emailHelp" value="<?= isset($dados['txtSenha']) ? $dados['txtSenha'] : ''; ?>">
                </div>
                <div class="mt-3 mb-3">
                    <label for="txtConfirmarSenha" class="form-label">Confirmar Senha</label>
                    <input type="password" name="txtConfirmarSenha" class="form-control" id="txtConfirmarSenha" aria-describedby="emailHelp" value="<?= isset($dados['txtConfirmarSenha']) ? $dados['txtConfirmarSenha'] : ''; ?>">
                </div>
                <input type="submit" name="sendUpdatePassword" id="sendUpdatePassword" class="w-100 btn btn-primary btn-xs" value="Atualizar Senha">
                <div class="mt-3 mb-3 form-check">
                    <a href="index.php" class="text-warning link-esqueceu-senha">LEMBROU SUA SENHA? CLIQUE AQUI</a>
                </div>
            </form>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="js/custom.js"></script> -->
</body>

</html>