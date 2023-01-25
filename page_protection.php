<?php

if((!isset($_SESSION['id'])) AND (!$_SESSION['name'])){
    header("Location: index.php");
    $_SESSION['msg'] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Error: Você precisa estar logado!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>';
}