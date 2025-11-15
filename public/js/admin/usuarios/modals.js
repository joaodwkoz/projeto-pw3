const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const disableInputs = () => {
    [inputImagem, nomeInput, emailInput].forEach(inp => inp.disabled = true);

    tipoInputs.forEach(tipoInput => tipoInput.disabled = true);

    modalBtns.classList.add('hidden');
}

const enableInputs = () => {
    [inputImagem, nomeInput, emailInput].forEach(inp => inp.disabled = false);

    tipoInputs.forEach(tipoInput => tipoInput.disabled = false);

    modalBtns.classList.remove('hidden');
}

const clearInputs = () => {
    [inputImagem, nomeInput, emailInput].forEach(inp => inp.value = '');

    tipoInputs.forEach(tipoInput => tipoInput.checked = false);

    mode = 0;

    usuarioId = -1;

    previewImagem.style.display = 'none';
    previewImagem.src = '#';
}