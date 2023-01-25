<?php
session_start();
ob_start();
include 'connection.php';
include 'page_protection.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <title>SIB - Sistema Integrado de Beneficios</title>
</head>

<body>
    <div class="container">
        <div class="d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm justify-content-between">

            <div class="">
                <h1 class="h6 mb-0 text-white lh-1">Cadastro de Usuários</h1>
            </div>
            <div>
                <h1 class="h6 mb-0 text-white lh-1">
                    <a href="logout.php" class="btn-logout">Sair</a>
                </h1>
            </div>
        </div>
        <div class="row">
            <form action="" method="post" name="cadUsuarioForm" id="cadUsuarioForm">
            <div id="msgAlertaErrorCad"></div>
                <div class="row">
                    <div class="col col-md-4">
                        <div class="mb-3">
                            <label for="txtName" class="form-label">Nome</label>
                            <input type="text" name="txtName" class="form-control" id="txtName" />
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="mb-3">
                            <label for="txtEmail" class="form-label">E-mail</label>
                            <input type="text" name="txtEmail" class="form-control" id="txtEmail" />
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="mb-3">
                            <label for="txtSenha" class="form-label">Senha</label>
                            <input type="password" name="txtSenha" class="form-control" id="txtSenha" />
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="mb-3">
                            <label for="cmbPerfil" class="form-label">Perfil</label>
                            <select name="cmbPerfil" id="cmbPerfil" class="form-select list-profile">
                                <option value="">Selecione</option>
                            </select>
                        </div>
                    </div>
                    <div class="col col-md-4">
                        <div class="col col-md-12" id="btn-create">
                            <div class="mb-3 d-grid gap-2 mx-auto" style="margin-top: 2rem!important; ">
                                <button type="submit" class="btn btn-primary btn-xs" id="cadUsuarioBtn">Cadastrar</button>
                            </div>
                        </div>
                        <div class="col col-md-12">
                            <div class="row" id="btn-update-cancel" style="display: none !important;">
                                <div class="col col-md-6">
                                    <div class="mb-3 d-grid gap-2 mx-auto" style="margin-top: 2rem!important;">
                                        <button type="button" class="btn btn-primary btn-xs" onclick="updateUser();">Atualizar</button>
                                        <input type="hidden" name="txtId" id="txtId" />
                                    </div>
                                </div>
                                <div class="col col-md-6">
                                    <div class="mb-3 d-grid gap-2 mx-auto" style="margin-top: 2rem!important;">
                                        <button type="submit" class="btn btn-secondary btn-xs" onclick="cancelUser();">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="row">
            <table id="dataTable" class="table table-striped list-users" style="width:100%">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>Perfil</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modal-title"></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="modal-body"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                </div>

            </div>
        </div>
    </div>
    <script src="assets/js/custom.js"></script>
    <script src="assets/js/jquery-3.5.1.js"></script>
    <script src="assets/js/jquery.dataTables.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        $(document).ready(function() {
            listUsers();
            $('#dataTable').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.11.5/i18n/pt-BR.json',
                    lengthMenu: 'Mostrar _MENU_ registros',
                    zeroRecords: 'Nenhum registro encontrado.',
                    info: 'Mostrando _PAGE_ de _PAGES_ registro(s)',
                    infoEmpty: 'No records available',
                    infoFiltered: '(filtered from _MAX_ total records)',
                    search: 'Buscar'
                },
            });
        });
    </script>
</body>

</html>