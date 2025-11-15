async function saveMovie() {
    const url = mode === 1 ? `../api/filmes/${filmeId}` : '../api/filmes/';

    const formBody = document.querySelector('#movie-form');
    const formData = new FormData(formBody);

    formData.append('classificacao_id', classificacaoId);

    generos.forEach(id => {
        formData.append('generos[]', id);
    });

    if (mode === 1) {
        formData.append('_method', 'PUT');
    }

    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Filme salvo com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao salvar o filme.',
        infoText: ''
    };

    try {
        const res = await fetch(url, {
            method: "POST",
            headers: { "Accept": "application/json" },
            body: formData
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || "Erro inesperado.";
            return showDialog(sucesso, erro, "erro", () => {});
        }

        showDialog(sucesso, erro, "sucesso", () => {
            fecharModal();
            location.reload();
        });

    } catch (e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function deleteMovie(filmeId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Filme excluído com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao excluir o filme.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/filmes/${filmeId}`, {
            method: 'DELETE',
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || "Erro inesperado.";
            return showDialog(sucesso, erro, "erro", () => {});
        }

        showDialog(sucesso, erro, "sucesso", () => {
            location.reload();
        });

    } catch(e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function reactivateMovie(filmeId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Filme reativado com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao reativar o filme.',
        infoText: ''
    };

    const url = `../api/filmes/${filmeId}/reativar`;

    try {
        const res = await fetch(url, {
            method: 'PUT',
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || "Erro inesperado.";
            return showDialog(sucesso, erro, "erro", () => {});
        }

        showDialog(sucesso, erro, "sucesso", () => {
            location.reload();
        });

    } catch(e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function fetchMovieById(filmeId) {
    document.querySelectorAll('.chip-input .option').forEach(opt => {
        opt.classList.remove('selected');
    });

    generos = [];

    const url = `../api/filmes/${filmeId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar filme.');
        return res.json();
    })
    .then(data => {
        if (data.capa) {
            previewImagem.src = document.querySelector('main').dataset.storageUrl + "/" + data.capa;
            previewImagem.style.display = 'block';
        }

        nomeInput.value = data.nome || '';
        diretorInput.value = data.diretor || '';
        lancamentoInput.value = Number(data.ano_lancamento) || '';
        sinopseInput.value = data.sinopse || '';
        trailerInput.value = data.trailer || '';

        data.generos.forEach(genero => {
            const chipBtn = document.querySelector(`.chip-input button[data-genero-id="${genero.id}"]`);
            if (chipBtn) {
                chipBtn.classList.add('selected');
                generos.push(genero.id);
            }
        });

        if (data.classificacao) {
            classificacaoId = data.classificacao.id;
            dropdownSelectedOptionSpan.textContent = data.classificacao.nome;
        }
    })
    .catch(error => {
        console.error('Erro ao buscar detalhes do filme:', error);
        alert('Não foi possível carregar os detalhes do filme.');
    });
}