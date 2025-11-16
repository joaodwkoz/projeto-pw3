const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const clearSpans = () => {
    [usuarioSpan, filmeSpan, comentarioSpan].forEach(span => span.textContent = '');

    stars.forEach(star => star.classList.remove('active'));

    avaliacaoId = -1;
}