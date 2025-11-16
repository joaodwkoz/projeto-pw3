const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const clearSpans = () => {
    [nomeSpan, emailSpan, assuntoSpan, mensagemSpan].forEach(span => span.textContent = '');

    contatoId = -1;
}