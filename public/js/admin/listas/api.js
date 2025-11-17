async function deleteList(listaId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Lista excluída com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao excluir a lista.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/listas/${listaId}`, {
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

async function reactivateList(listaId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Lista reativada com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao reativar a lista. Tente novamente.',
        infoText: ''
    };

    const url = "../api/listas/" + listaId + "/reativar";

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

async function fetchListById(listaId) {
    const url = `../api/listas/${listaId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar gênero.');
        return res.json();
    })
    .then(data => {
        usuarioSpan.textContent = data.usuario.nome;
        nomeSpan.textContent = data.nome;
        descricaoSpan.textContent = data.descricao;

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
        console.error('Erro ao buscar detalhes da lista:', error);
        alert('Não foi possível carregar os detalhes da lista.');
    });
}