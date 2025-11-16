async function deleteReview(avaliacaoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Avaliação excluída com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao excluir a avaliação.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/avaliacoes/${avaliacaoId}`, {
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

async function reactivateReview(avaliacaoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Avaliação reativada com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao reativar a avaliação. Tente novamente.',
        infoText: ''
    };

    const url = "../api/avaliacoes/" + avaliacaoId + "/reativar";

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

async function fetchReviewById(avaliacaoId) {
    const url = `../api/avaliacoes/${avaliacaoId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar avaliação.');
        return res.json();
    })
    .then(data => {
        usuarioSpan.textContent = data.usuario.nome;
        filmeSpan.textContent = data.filme.nome;

        stars.forEach((star, index) => {
            if (index + 1 <= Number(data.nota)) {
                star.classList.add('active');
            }
        });

        comentarioSpan.textContent = data.comentario;
    })
    .catch(error => {
        console.error('Erro ao buscar detalhes da avaliação:', error);
        alert('Não foi possível carregar os detalhes da avaliação.');
    });
}