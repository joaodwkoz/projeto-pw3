const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const disableInputs = () => {
    [nomeInput, corInput].forEach(inp => inp.disabled = true);

    modalBtns.classList.add('hidden');
}

const enableInputs = () => {
    [nomeInput, corInput].forEach(inp => inp.disabled = false);

    modalBtns.classList.remove('hidden');
}

const showFilmeGroup = () => {
    filmeGroup.classList.remove('hidden');
}

const hideFilmeGroup = () => {
    filmeGroup.classList.add('hidden');
}

const clearInputs = () => {
    [nomeInput, corInput].forEach(inp => inp.value = '');

    moviesList.innerHTML = '';

    filmeGroup.querySelector('span').textContent = 'Filmes (0)';

    corSelector.style.backgroundColor = '#fff';

    mode = 0;

    generoId = -1;

    hideFilmeGroup();
}