<?php
session_start();
ob_start();
include 'connection.php';
include 'uteis.php';

$uteis = new Uteis();

$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

if (!empty($dados['sendToRecover'])) {
    $searchUser = "SELECT id, nome, email FROM users WHERE email = :email LIMIT 1";
    $resultSearch = $conn->prepare($searchUser);
    $resultSearch->bindParam(':email', $dados['txtEmail'], PDO::PARAM_STR);
    $resultSearch->execute();

    if (($resultSearch) and $resultSearch->rowCount() != 0) {
        $row_user = $resultSearch->fetch(PDO::FETCH_ASSOC);
        $hash_user_recover = password_hash($row_user['id'], PASSWORD_DEFAULT);
        $updateUser = "UPDATE users SET hash_user_recover = :hash_user_recover WHERE id = :id LIMIT 1";
        $resultUpdateUser = $conn->prepare($updateUser);
        $resultUpdateUser->bindParam(':hash_user_recover', $hash_user_recover);
        $resultUpdateUser->bindParam(':id', $row_user['id']);
        if ($resultUpdateUser->execute()) {
            $link = "http://localhost/update_password.php?key=$hash_user_recover";

            $response = $uteis->sendEmail($link, $row_user);

            if (!$response['error']) {
                $_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
                header("Location: index.php");
            }
        } else {
            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error: Tente novamente!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
        }
    } else {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error: E-mail não cadastrado!
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>';
    }
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
    <title>Recuperar Senha - SIB - Sistema Integrado de Beneficios</title>
</head>

<body>
    <div class="container">
        <main class="form-signin">
            <form method="POST" action="">
                <div class="text-center">
                    <img class="mb-5" src="assets/img/logo_sib.png" alt="" width="250" height="115">
                </div>
                <?php
                if (isset($_SESSION['msg_rec'])) {
                ?>
                    <?= $_SESSION['msg_rec']; ?>
                <?php
                    unset($_SESSION['msg_rec']);
                }
                ?>
                <div class="mt-3 mb-3">
                    <label for="txtEmail" class="form-label">E-mail</label>
                    <input type="email" name="txtEmail" class="form-control" id="txtEmail" aria-describedby="emailHelp" value="<?= isset($dados['txtEmail']) ? $dados['txtEmail'] : ''; ?>">
                </div>
                <input type="submit" name="sendToRecover" id="sendToRecover" class="w-100 btn btn-primary btn-xs" value="Recuperar">
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