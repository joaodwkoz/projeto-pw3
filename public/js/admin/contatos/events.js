verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearSpans();

        contatoId = e.target.closest('.contacts-list-row').dataset.contatoId;

        modalTitle.textContent = 'Ver contato';

        await fetchContactById(contatoId);

        abrirModal();
    });
});

resolverBtns.forEach(resolverBtn => {
    resolverBtn.addEventListener('click', (e) => {
        contatoId = e.target.closest('.contacts-list-row').dataset.contatoId;

        showAlertDialog('Você tem certeza desta mudança de status?', 'Essa ação ocasionará na mudança de status para "resolvido".', () => {
            resolveContact(contatoId);
        }, () => {

        });
    });
});

naoResolverBtns.forEach(naoResolverBtn => {
    naoResolverBtn.addEventListener('click', (e) => {
        contatoId = e.target.closest('.contacts-list-row').dataset.contatoId;

        showAlertDialog('Você tem certeza desta mudança de status', 'Essa ação ocasionará na mudança de status para "não resolvido".', () => {
            unresolveContact(contatoId);
        }, () => {

        });
    });
});

modalCloseBtn.addEventListener('click', () => {
    clearSpans();
    fecharModal();
});