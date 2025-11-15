inputImagem.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const file = e.target.files[0];

        if (!file.type.startsWith('image/')) {
            console.error("O arquivo selecionado não é uma imagem.");
            previewImagem.src = "";
            previewImagem.style.display = 'none';
            return;
        }

        const reader = new FileReader();

        reader.onload = function(ev) {
            previewImagem.src = ev.target.result;
            previewImagem.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
});

verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearInputs();

        usuarioId = e.target.closest('.users-list-row').dataset.usuarioId;

        mode = 0;

        disableInputs();

        modalTitle.textContent = 'Ver usuário';

        await fetchUserById(usuarioId);

        abrirModal();
    });
});

editarBtns.forEach(editarBtn => {
    editarBtn.addEventListener('click', async (e) => {
        clearInputs();

        usuarioId = e.target.closest('.users-list-row').dataset.usuarioId;

        enableInputs();

        mode = 1;

        modalTitle.textContent = 'Editar usuário';

        await fetchUserById(usuarioId);

        abrirModal();
    });
});

deletarBtns.forEach(deletarBtn => {
    deletarBtn.addEventListener('click', (e) => {
        usuarioId = e.target.closest('.users-list-row').dataset.usuarioId;

        showAlertDialog('Você tem certeza de excluir este usuário?', 'Essa ação ocasionará no bloqueio do acesso do usuário, em paralelo, seu status será alterado para "deletado".', () => {
            deleteUser(usuarioId);
        }, () => {

        });
    });
});

reativarBtns.forEach(reativarBtn => {
    reativarBtn.addEventListener('click', (e) => {
        usuarioId = e.target.closest('.users-list-row').dataset.usuarioId;

        showAlertDialog('Você tem certeza em reativar este usuário?', 'Essa ação ocasionará no desbloqueio do acesso do usuário, em paralelo, seu status será alterado para "ativo".', () => {
            reactivateUser(usuarioId);
        }, () => {

        });
    });
});

saveUserBtn.addEventListener('click', () => {
    saveUser();
});

[cancelUserBtn, modalCloseBtn].forEach(cancel => {
    cancel.addEventListener('click', () => {
        clearInputs();
        fecharModal();
    });
});

addUserBtn.addEventListener('click', () => {
    clearInputs();

    modalTitle.textContent = 'Adicionar usuário';

    abrirModal();
});