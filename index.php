<?php
session_start();
ob_start();
include 'connection.php';
$dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
if (!empty($dados['sendLogin'])) {
    $searchUser = "SELECT id, nome, email, password FROM users WHERE email = :email LIMIT 1";
    $resultSearch = $conn->prepare($searchUser);
    $resultSearch->bindParam(':email', $dados['txtEmail'], PDO::PARAM_STR);
    $resultSearch->execute();

    if (($resultSearch) and $resultSearch->rowCount() != 0) {
        $row_user = $resultSearch->fetch(PDO::FETCH_ASSOC);
        if (password_verify($dados['txtSenha'], $row_user['password'])) {
            $_SESSION['id'] = $row_user['id'];
            $_SESSION['nome'] = $row_user['nome'];
            $_SESSION['email'] = $row_user['email'];
            header("Location: users-create.php");
        } else {
            $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    Error: Login ou Senha inválido!
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
        }
    } else {
        $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                Error: Login ou Senha inválido!
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
    <title>Login - SIB - Sistema Integrado de Beneficios</title>
</head>

<body>
    <div class="container">
        <main class="form-signin">

            <form method="POST" action="">
                <div class="text-center">
                    <img class="mb-5" src="assets/img/logo_sib.png" alt="" width="250" height="115">
                </div>
                <?php
                if (isset($_SESSION['msg'])) {
                ?>
                    <?= $_SESSION['msg']; ?>
                <?php
                    unset($_SESSION['msg']);
                }
                ?>
                <div class="mt-3 mb-3">
                    <label for="txtEmail" class="form-label">E-mail</label>
                    <input type="email" name="txtEmail" class="form-control" id="txtEmail" aria-describedby="emailHelp" value="<?= isset($dados['txtEmail']) ? $dados['txtEmail'] : ''; ?>">
                </div>
                <div class="mb-3">
                    <label for="txtSenha" class="form-label">Senha</label>
                    <input type="password" name="txtSenha" class="form-control" id="txtSenha" value="<?= isset($dados['txtSenha']) ? $dados['txtSenha'] : ''; ?>">
                </div>
                <input type="submit" name="sendLogin" id="sendLogin" class="w-100 btn btn-primary btn-xs" value="Acessar">
                <div class="mt-3 mb-3 form-check">
                    <a href="recover_password.php" class="text-warning link-esqueceu-senha">ESQUECEU SUA SENHA? CLIQUE AQUI</a>
                </div>
            </form>
        </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <!-- <script src="js/custom.js"></script> -->
</body>

</html>