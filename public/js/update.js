document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#update-modal-fade');
    const close = modal.querySelector('.close');

    const openModal = () => {
        modal.classList.remove('hidden');
    }

    const closeModal = () => {
        modal.classList.add('hidden');
    }

    const updateBtns = document.querySelectorAll('.edit-btn');

    updateBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            openModal();

            const userId = e.target.closest('.row').dataset.userId;

            modal.dataset.userId = userId;
        })
    });

    const form = document.querySelector('#update-form');
    const nomeInput = document.querySelector('#nome-input');
    const emailInput = document.querySelector('#email-input');

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const formData = new FormData(form);
        formData.append('ehAdmin', tipo === 'usuario' ? 0 : 1);
        formData.append('status', 'Ativo');
        formData.append('_method', 'PUT');

        const response = await fetch(`/api/usuarios/${parseInt(modal.dataset.userId)}`, {
            method: 'POST',
            body: formData
        });

        if (response.ok) {
            location.reload();
        } 

        closeModal();
        limparModal();
    });

    const cancelBtn = document.querySelector('#cancel-edit-btn');

    [cancelBtn, close].forEach(it => {
        it.addEventListener('click', () => {
            closeModal();
            limparModal();
        })
    })

    const select = document.querySelector('.select');
    const selectSpan = select.querySelector('span');
    const optionsContainer = select.querySelector('.options');
    const options = optionsContainer.querySelectorAll('li');

    let tipo = 'usuario';

    select.addEventListener('click', (e) => {
        if (optionsContainer.classList.contains('hidden')) {
            optionsContainer.classList.remove('hidden');
        } else {
            optionsContainer.classList.add('hidden');
        }
    });

    const mapa = {
        'usuario': 'Usuário',
        'admin': 'Admin',
    }

    options.forEach(opt => {
        opt.addEventListener('click', (e) => {
            e.stopPropagation();

            for (op of options) {
                if (op.classList.contains('active')) {
                    op.classList.remove('active')
                }
            }

            optionsContainer.classList.add('hidden');
            opt.classList.add('active');
            tipo = opt.dataset.value;
            selectSpan.textContent = mapa[tipo];
        });
    });

    function limparModal () {
        nomeInput.value = "";
        emailInput.value = "";
        selectSpan.textContent = 'Usuário';

        for (opt of options) {
            if (opt.dataset.value == 'usuario') {
                opt.classList.add('active');
            } else {
                opt.classList.remove('active');
            }
        }
    }
});