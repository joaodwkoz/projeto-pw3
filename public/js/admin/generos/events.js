verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearInputs();

        generoId = e.target.closest('.genres-list-row').dataset.generoId;

        mode = 0;

        disableInputs();

        showFilmeGroup();

        modalTitle.textContent = 'Ver gênero';

        await fetchGenreById(generoId);

        abrirModal();
    });
});

editarBtns.forEach(editarBtn => {
    editarBtn.addEventListener('click', async (e) => {
        clearInputs();

        generoId = e.target.closest('.genres-list-row').dataset.generoId;

        enableInputs();

        mode = 1;

        modalTitle.textContent = 'Editar gênero';

        await fetchGenreById(generoId);

        abrirModal();
    });
});

deletarBtns.forEach(deletarBtn => {
    deletarBtn.addEventListener('click', (e) => {
        generoId = e.target.closest('.genres-list-row').dataset.generoId;

        showAlertDialog('Você tem certeza de excluir este gênero?', 'Essa ação ocasionará no bloqueio do acesso do usuário ao gênero, em paralelo, seu status será alterado para "deletado".', () => {
            deleteGenre(generoId);
        }, () => {

        });
    });
});

reativarBtns.forEach(reativarBtn => {
    reativarBtn.addEventListener('click', (e) => {
        generoId = e.target.closest('.genres-list-row').dataset.generoId;

        showAlertDialog('Você tem certeza em reativar este gênero?', 'Essa ação ocasionará no desbloqueio do acesso do usuário ao gênero, em paralelo, seu status será alterado para "ativo".', () => {
            reactivateGenre(generoId);
        }, () => {

        });
    });
});

saveGenreBtn.addEventListener('click', () => {
    saveGenre();
});

[cancelGenreBtn, modalCloseBtn].forEach(cancel => {
    cancel.addEventListener('click', () => {
        clearInputs();
        fecharModal();
    });
});

addGenreBtn.addEventListener('click', () => {
    clearInputs();

    enableInputs();

    modalTitle.textContent = 'Adicionar gênero';

    abrirModal();
});

corInput.addEventListener('input', (e) => {
    if (e.target.value.length < 4) {
        corSelector.style.backgroundColor = '#fff';
    } else {
        corSelector.style.backgroundColor = e.target.value;
    }
});