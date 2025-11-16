async function saveGenre() {
    const url = mode === 1 ? `../api/generos/${generoId}` : '../api/generos/';
    
    const formBody = document.querySelector('#genre-form');
    const formData = new FormData(formBody);

    if (mode === 1) {
        formData.append('_method', 'PUT');
    }

    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: "Sucesso!",
        text: "Gênero salvo com sucesso!"
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: "Deu ruim!",
        text: "Ocorreu um erro ao salvar o gênero.",
        infoText: ""
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

    } catch (err) {
        erro.infoText = err.message;
        showDialog(sucesso, erro, "erro", () => {});
    }
}

async function deleteGenre(generoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Gênero excluído com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao excluir o gênero.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/generos/${generoId}`, {
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

async function reactivateGenre(generoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Gênero reativado com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao reativar o gênero. Tente novamente.',
        infoText: ''
    };

    const url = "../api/generos/" + generoId + "/reativar";

    try {
        const res = await fetch(url, {
            method: 'PUT',
            headers: { 'Accept': 'application/json' }
        });

        const data = await res.json();

        if (!res.ok || !data.success) {
            erro.infoText = data.error || 'Erro inesperado.';
            return showDialog(sucesso, erro, 'erro', () => {});
        }

        showDialog(sucesso, erro, 'sucesso', () => {
            location.reload();
        });

    } catch (e) {
        erro.infoText = e.message;
        showDialog(sucesso, erro, 'erro', () => {});
    }
}

async function fetchGenreById(generoId) {
    const url = `../api/generos/${generoId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar gênero.');
        return res.json();
    })
    .then(data => {
        nomeInput.value = data.nome;
        corInput.value = data.cor;
        corSelector.style.backgroundColor = data.cor;

        let moviesListHtml = '';

        if (data.filmes) {
            filmeGroup.querySelector('span').textContent = `Filmes (${data.filmes.length})`

            if (data.filmes.length > 0) {
                for (const filme of data.filmes) {
                    moviesListHtml += `
                        <div class="movie">
                            <div class="marker"></div>

                            <div class="movie-poster">
                                <img src="${filme.capa ? storageUrl + '/' + filme.capa : ''}" alt="" ${filme.capa ? '' : 'style="display: none;"'}>
                            </div>

                            <span class="movie-title">
                                ${filme.nome}
                            </span>
                        </div>
                    `;
                }
            }
        }

        moviesList.innerHTML = moviesListHtml;
    })
    .catch(error => {
        console.error('Erro ao buscar detalhes do gênero:', error);
        alert('Não foi possível carregar os detalhes do gênero.');
    });
}