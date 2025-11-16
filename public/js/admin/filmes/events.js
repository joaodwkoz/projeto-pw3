inputImagem.addEventListener('change', function(e) {
    if (e.target.files && e.target.files[0]) {
        const file = e.target.files[0];

        if (!file.type.startsWith('image/')) {
            console.error("O arquivo selecionado não é uma imagem.");
            previewImagem.src = "";
            previewImagem.style.display = 'none';
            return;
        }

        const reader = new FileReader();

        reader.onload = function(ev) {
            previewImagem.src = ev.target.result;
            previewImagem.style.display = 'block';
        };

        reader.readAsDataURL(file);
    }
});

chipInputOptions.forEach(chipInputOption => {
    chipInputOption.addEventListener('click', () => {
        if (mode === 1) {
            const id = Number(chipInputOption.dataset.generoId);

            const index = generos.indexOf(id); 

            if (chipInputOption.classList.contains('selected')) {
                if (index > -1) {
                    generos.splice(index, 1);
                }
                chipInputOption.classList.remove('selected');
            } else {
                if (index === -1) { 
                    generos.push(id);
                }
                chipInputOption.classList.add('selected');
            }
            
            console.log("Gêneros Ativos:", generos);
        }
    });
});

dropdownSelectedOption.addEventListener('click', () => {
    if (mode === 1) {
        if (dropdownMenu.classList.contains('hidden')) {
            dropdownMenu.classList.remove('hidden');
        } else {
            dropdownMenu.classList.add('hidden');
        }
    }
});

dropdownBtns.forEach(dropdownBtn => {
    dropdownBtn.addEventListener('click', () => {
        if (mode === 1) {
            const novoTexto = dropdownBtn.querySelector('span').textContent.trim();
            
            dropdownSelectedOptionSpan.textContent = novoTexto; 
            
            classificacaoId = dropdownBtn.dataset.classificacaoId;

            dropdownMenu.classList.add('hidden');
        }
    })
});

verBtns.forEach(verBtn => {
    verBtn.addEventListener('click', async (e) => {
        clearInputs();

        filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

        mode = 0;

        disableInputs();

        modalTitle.textContent = 'Ver filme';

        await fetchMovieById(filmeId);

        abrirModal();
    });
});

editarBtns.forEach(editarBtn => {
    editarBtn.addEventListener('click', async (e) => {
        clearInputs();

        filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

        enableInputs();

        mode = 1;

        modalTitle.textContent = 'Editar filme';

        await fetchMovieById(filmeId);

        abrirModal();
    });
});

deletarBtns.forEach(deletarBtn => {
    deletarBtn.addEventListener('click', (e) => {
        filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

        showAlertDialog('Você tem certeza de excluir este filme?', 'Essa ação ocasionará no bloqueio do acesso do usuário ao filme, em paralelo, seu status será alterado para "deletado".', () => {
            deleteMovie(filmeId);
        }, () => {

        });
    });
});

reativarBtns.forEach(reativarBtn => {
    reativarBtn.addEventListener('click', (e) => {
        filmeId = e.target.closest('.movies-list-row').dataset.filmeId;

        showAlertDialog('Você tem certeza em reativar este filme?', 'Essa ação ocasionará no desbloqueio do acesso do usuário ao filme, em paralelo, seu status será alterado para "ativo".', () => {
            reactivateMovie(filmeId);
        }, () => {

        });
    });
});

saveMovieBtn.addEventListener('click', () => {
    saveMovie();
});

[cancelMovieBtn, modalCloseBtn].forEach(cancel => {
    cancel.addEventListener('click', () => {
        clearInputs();
        fecharModal();
    });
});

addMovieBtn.addEventListener('click', () => {
    clearInputs();

    enableInputs();

    modalTitle.textContent = 'Adicionar filme';

    abrirModal();
});