const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const showFilmeGroup = () => {
    filmeGroup.classList.remove('hidden');
}

const hideFilmeGroup = () => {
    filmeGroup.classList.add('hidden');
}

const clearSpans = () => {
    [usuarioSpan, nomeSpan, descricaoSpan].forEach(span => span.textContent = '');

    filmeGroup.querySelector('span').textContent = 'Filmes (0)';

    moviesList.innerHTML = '';

    mode = 0;

    listaId = -1;

    hideFilmeGroup();
}