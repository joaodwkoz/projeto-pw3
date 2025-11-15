const alertDialogModalFade = document.querySelector('#alert-modal-fade');
const alertDialogModal = alertDialogModalFade.querySelector('#alert-modal');
const alertDialogTitle = alertDialogModal.querySelector('.modal-title');
const alertDialogText = alertDialogModal.querySelector('.text');

const showAlertDialog = (title, text, saveFunc, cancelFunc) => {
    alertDialogTitle.textContent = title;
    alertDialogText.textContent = text;

    const continueAlertDialogBtn = alertDialogModal.querySelector('#continue-alert-btn');
    const cancelAlertDialogBtn = alertDialogModal.querySelector('#cancel-alert-btn');

    const newContinueBtn = continueAlertDialogBtn.cloneNode(true);
    continueAlertDialogBtn.parentNode.replaceChild(newContinueBtn, continueAlertDialogBtn);

    const newCancelBtn = cancelAlertDialogBtn.cloneNode(true);
    cancelAlertDialogBtn.parentNode.replaceChild(newCancelBtn, cancelAlertDialogBtn);

    newContinueBtn.addEventListener('click', () => {
        saveFunc();
        alertDialogModalFade.classList.add('hidden');
    });

    newCancelBtn.addEventListener('click', () => {
        cancelFunc();
        alertDialogModalFade.classList.add('hidden');
    });

    alertDialogModalFade.classList.remove('hidden');
}