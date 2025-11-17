verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearSpans();

        listaId = e.target.closest('.lists-list-row').dataset.listaId;

        mode = 0;

        showFilmeGroup();

        modalTitle.textContent = 'Ver lista';

        await fetchListById(listaId);

        abrirModal();
    });
});

deletarBtns.forEach(deletarBtn => {
    deletarBtn.addEventListener('click', (e) => {
        listaId = e.target.closest('.lists-list-row').dataset.listaId;

        showAlertDialog('Você tem certeza de excluir essa lista?', 'Essa ação ocasionará no bloqueio do acesso do usuário à lista, em paralelo, seu status será alterado para "deletado".', () => {
            deleteList(listaId);
        }, () => {

        });
    });
});

reativarBtns.forEach(reativarBtn => {
    reativarBtn.addEventListener('click', (e) => {
        listaId = e.target.closest('.lists-list-row').dataset.listaId;

        showAlertDialog('Você tem certeza em reativar essa lista?', 'Essa ação ocasionará no desbloqueio do acesso do usuário à lista, em paralelo, seu status será alterado para "ativo".', () => {
            reactivateList(listaId);
        }, () => {

        });
    });
});

modalCloseBtn.addEventListener('click', () => {
    clearSpans();
    fecharModal();
});