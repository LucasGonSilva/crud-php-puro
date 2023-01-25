const tbody = document.querySelector(".list-users tbody");
const selectProfile = document.querySelector(".list-profile");
const cadForm = document.getElementById("cadUsuarioForm");
const msgAlertaErrorCad = document.getElementById("msgAlertaErrorCad");
const msgAlerta = document.getElementById("msgAlerta");


const listUsers = async () => {
    const dados = await fetch("../../users/list.php");
    const resposta = await dados.text();
    tbody.innerHTML = resposta;
}
//listUsers();

const listProfiles = async () => {
    const dados = await fetch("../../listProfile.php");
    const resposta = await dados.text();
    selectProfile.innerHTML = resposta;
}
listProfiles();

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    msgAlertaErrorCad.innerHTML = "";
    
    document.getElementById("cadUsuarioBtn").value = "Salvando...";

    if(document.getElementById("txtName").value == ""){
        msgAlertaErrorCad.innerHTML = "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo nome!</div>";
    } else if(document.getElementById("txtEmail").value == ""){
        msgAlertaErrorCad.innerHTML = "<div class='alert alert-danger' role='alert'>Error: Necessário preencher o campo email!</div>";
    } else if(document.getElementById("cmbPerfil").value == ""){
            msgAlertaErrorCad.innerHTML = "<div class='alert alert-danger' role='alert'>Error: Necessário selecionar um perfil!</div>";
    } else {
        const dadosForm = new FormData(cadForm);
        dadosForm.append("add", 1);
        
        const dados = await fetch("../../users/create.php", {
            method: "POST",
            body: dadosForm,
        });

        listUsers();
    }

    document.getElementById("cadUsuarioBtn").value = "Cadastrar";
    cadForm.reset();
});

async function changeUser(id) {
    $('#btn-create').hide();
    $('#btn-update-cancel').show();
    const dados = await fetch('../../users/view.php?id=' + id);
    const resposta = await dados.json();
    console.log(id);

    document.getElementById("txtId").value = id;
    document.getElementById("txtName").value = resposta['dados'].nome;
    document.getElementById("txtEmail").value = resposta['dados'].email;
    document.getElementById("cmbPerfil").value = resposta['dados'].profile_id;
}

async function updateUser() {
    var id = document.getElementById("txtId").value;
    var nome = document.getElementById("txtName").value;
    var email = document.getElementById("txtEmail").value;
    var profile = document.getElementById("cmbPerfil").value;

    var dadosForm = `id=${id}&nome=${nome}&email=${email}&profile=${profile}`;
    const dados = await fetch('../../users/edit.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: dadosForm
    });

    $('#exampleModal' + id).modal('hide');
    $('#myModal').modal('show');
    $('#modal-title').html('Usuário Atualizado');
    $('#modal-body').html('Usuário atualizado com sucesso!');
    cadForm.reset();
    listUsers();
    cancelUser();
}

async function cancelUser() {
    $('#btn-update-cancel').hide();
    $('#btn-create').show();
}

async function deleteUser(id) {
    const dados = await fetch('../../users/delete.php?id=' + id);
    $('#exampleModal' + id).modal('hide');
    $('#myModal').modal('show');
    $('#modal-title').html('Usuário Removido');
    $('#modal-body').html('Usuário removido com sucesso!');
    listUsers();
}