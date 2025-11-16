verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearSpans();

        avaliacaoId = e.target.closest('.reviews-list-row').dataset.avaliacaoId;

        modalTitle.textContent = 'Ver avaliação';

        await fetchReviewById(avaliacaoId);

        abrirModal();
    });
});

deletarBtns.forEach(deletarBtn => {
    deletarBtn.addEventListener('click', (e) => {
        avaliacaoId = e.target.closest('.reviews-list-row').dataset.avaliacaoId;

        showAlertDialog('Você tem certeza de excluir esta avaliação?', 'Essa ação ocasionará no bloqueio do acesso do usuário à avaliação, em paralelo, seu status será alterado para "deletado".', () => {
            deleteReview(avaliacaoId);
        }, () => {

        });
    });
});

reativarBtns.forEach(reativarBtn => {
    reativarBtn.addEventListener('click', (e) => {
        avaliacaoId = e.target.closest('.reviews-list-row').dataset.avaliacaoId;

        showAlertDialog('Você tem certeza em reativar esta avaliação?', 'Essa ação ocasionará no desbloqueio do acesso do usuário à avaliação, em paralelo, seu status será alterado para "ativo".', () => {
            reactivateReview(avaliacaoId);
        }, () => {

        });
    });
});

modalCloseBtn.addEventListener('click', () => {
    clearSpans();
    fecharModal();
});