<?php

session_start();

ob_start();

unset($_SESSION['id'], $_SESSION['name'], $_SESSION['email']);

$_SESSION['msg'] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                        Você foi deslogado com sucesso!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';

header("Location: index.php");