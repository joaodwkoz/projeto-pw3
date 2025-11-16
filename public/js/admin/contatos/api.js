async function resolveContact(contatoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Contato marcado como resolvido com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao marcar o contato como resolvido.',
        infoText: ''
    };

    try {
        const res = await fetch(`../api/contatos/${contatoId}/resolver`, {
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

async function unresolveContact(contatoId) {
    const sucesso = {
        img: imgsUrl + "/modal-sucesso.png",
        title: 'Sucesso!',
        text: 'Contato marcado como não resolvido com sucesso!',
    };

    const erro = {
        img: imgsUrl + "/modal-erro.png",
        title: 'Deu ruim!',
        text: 'Ocorreu um erro ao marcar o contato como não resolvido. Tente novamente.',
        infoText: ''
    };

    const url = "../api/contatos/" + contatoId + "/nao-resolver";

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

async function fetchContactById(contatoId) {
    const url = `../api/contatos/${contatoId}`;

    await fetch(url)
    .then(res => {
        if (!res.ok) throw new Error('Falha ao buscar contato.');
        return res.json();
    })
    .then(data => {
        nomeSpan.textContent = data.nome;
        emailSpan.textContent = data.email;
        assuntoSpan.textContent = data.assunto;
        mensagemSpan.textContent = data.mensagem;
    })
    .catch(error => {
        console.error('Erro ao buscar detalhes do contato:', error);
        alert('Não foi possível carregar os detalhes do contato.');
    });
}