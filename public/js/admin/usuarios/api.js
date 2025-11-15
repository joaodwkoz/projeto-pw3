async function saveUser() {
    const url = mode === 1 ? `../api/usuarios/${usuarioId}` : '../api/usuarios/';
    const formBody = document.querySelector('#user-form');
    const formData = new FormData(formBody);

    if (mode === 1) {
        formData.append('_method', 'PUT');
    }

    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: "Sucesso!",
        text: "Usuário salvo com sucesso!"
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: "Deu ruim!",
        text: "Ocorreu um erro ao salvar o usuário.",
        infoText: ""
    };

    try {
        const res = await fetch(url, {
            method: "POST",
            headers: { "Accept": "application/json" },
            body: formData
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || "Erro inesperado.";
            return showDialog(sucesso, erro, "erro", () => {});
        }

        showDialog(sucesso, erro, "sucesso", () => {
            fecharModal();
            location.reload();
        });

    } catch (err) {
        erro.infoText = err.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function deleteUser(usuarioId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Usuário excluído com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao excluir o usuário.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/usuarios/${usuarioId}`, {
            method: 'DELETE',
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || "Erro inesperado.";
            return showDialog(sucesso, erro, "erro", () => {});
        }

        showDialog(sucesso, erro, "sucesso", () => {
            location.reload();
        });

    } catch(e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function reactivateUser(usuarioId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Usuário reativado com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao reativar o usuário. Tente novamente.',
        infoText: ''
    };

    const url = "../api/usuarios/" + usuarioId + "/reativar";

    try {
        const res = await fetch(url, {
            method: 'PUT',
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || 'Erro inesperado.';
            return showDialog(sucesso, erro, 'erro', () => {});
        }

        showDialog(sucesso, erro, 'sucesso', () => {
            location.reload();
        });

    } catch (e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, 'erro', () => {});
    }
}

async function fetchUserById(usuarioId) {
    const url = `../api/usuarios/${usuarioId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar usuário.');
        return res.json();
    })
    .then(data => {
        if (data.fotoPerfil) {
            previewImagem.src = document.querySelector('main').dataset.storageUrl + "/" + data.fotoPerfil;
            previewImagem.style.display = 'block';    
        }

        nomeInput.value = data.nome || '';
        emailInput.value = data.email;

        tipoInputs.forEach(tipoInput => {
            if (tipoInput.value == String(data.ehAdmin)) {
                tipoInput.checked = true;
            } else {
                tipoInput.checked = false;
            }
        });
    })
    .catch(error => {
        console.error('Erro ao buscar detalhes do usuário:', error);
        alert('Não foi possível carregar os detalhes do usuário.');
    });
}