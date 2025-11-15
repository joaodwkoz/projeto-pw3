const fecharModal = () => modal.classList.add('hidden');

const abrirModal = () => modal.classList.remove('hidden');

const disableInputs = () => {
    [inputImagem, nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.disabled = true);
    modalBtns.classList.add('hidden');
}

const enableInputs = () => {
    [inputImagem, nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.disabled = false);
    modalBtns.classList.remove('hidden');
}

const clearInputs = () => {
    [nomeInput, diretorInput, lancamentoInput, sinopseInput, trailerInput].forEach(inp => inp.value = '');

    generos = [];

    mode = 0;

    filmeId = -1;

    previewImagem.style.display = 'none';
    previewImagem.src = '#';

    chipInputOptions.forEach(chipInputOption => {
        chipInputOption.classList.remove('selected');
    });

    classificacaoId = 1;

    dropdownSelectedOptionSpan.textContent = 'Livre'; 
}