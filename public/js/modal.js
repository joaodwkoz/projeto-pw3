document.addEventListener("DOMContentLoaded", () => {
    const modal = document.querySelector('#delete-modal-fade');
    const input = modal.querySelector('input');

    const form = document.querySelector('form');

    const deleteBtns = document.querySelectorAll('.delete-btn');

    deleteBtns.forEach(btn => {
        btn.addEventListener('click', (e) => {
            const tg = e.target.closest('.row');
            const userId = tg.dataset.userId;
            const userName = tg.dataset.userName;

            modal.dataset.userId = userId;
            modal.dataset.userName = userName;

            limparModal();

            input.placeholder = userName;
            modal.querySelector('.delete-input-text .bold').textContent = userName;

            modal.classList.remove('hidden');
        });
    });

    modal.querySelector('#cancel-btn').addEventListener('click', (e) => {
        e.preventDefault();
        modal.classList.add('hidden');
        limparModal();
    });

    form.addEventListener('submit', async (e) => {
        e.preventDefault();

        const text = input.value;

        if(text != modal.dataset.userName){
            input.style.border = "3px solid #F55D5D";
            input.style.color = "#F55D5D";
            return;
        } else {
            const response = await fetch(`/api/dashboard/usuarios/${parseInt(modal.dataset.userId)}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': "application/json",
                },
            });

            if(response.ok){
                modal.classList.add('hidden');
                limparModal();
                location.reload();
            } else {
                input.style.border = "3px solid #828282";
                input.style.color = "#fff";
            }
        }
    })

    function limparModal(){
        input.value = "";
        input.placeholder = "";
        input.style.border = "3px solid #828282";
        input.style.color = "#fff";

        modal.querySelector('.delete-input-text .bold').textContent = "";
        modal.dataset.userId = "";
        modal.dataset.userName = "";
    }
})