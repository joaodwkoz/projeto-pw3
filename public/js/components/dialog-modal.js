const dialogModalFade = document.querySelector('#dialog-modal-fade');
const dialogModal = dialogModalFade.querySelector('#dialog-modal');
const dialogModalHeaderImg = dialogModal.querySelector('.modal-header img');
const dialogModalTitle = dialogModal.querySelector('.title');
const dialogModalText = dialogModal.querySelector('.text');
const dialogModalInfo = dialogModal.querySelector('.info');
const dialogModalInfoBoxText = dialogModalInfo.querySelector('.box > span');
const dialogModalContinueBtn = dialogModal.querySelector('#continue-dialog-btn');

let timer;
let continueFunc;

const showDialog = (sucesso, erro, tipo, func) => {
    dialogModal.classList.remove('sucesso');
    dialogModal.classList.remove('erro');
    
    continueFunc = func;

    if (tipo === 'sucesso') {
        dialogModal.classList.add('sucesso');
        dialogModalHeaderImg.src = sucesso.img;
        dialogModalTitle.textContent = sucesso.title;
        dialogModalText.textContent = sucesso.text;
        dialogModalInfo.classList.add('hidden');
    } else {
        dialogModal.classList.add('erro');
        dialogModalHeaderImg.src = erro.img;
        dialogModalTitle.textContent = erro.title;
        dialogModalText.textContent = erro.text;
        dialogModalInfo.classList.remove('hidden');
        dialogModalInfoBoxText.textContent = erro.infoText;
    }

    dialogModalFade.classList.remove('hidden');

    timer = setInterval(() => {
        dialogModalFade.classList.add('hidden');
        continueFunc();
    }, 500000); // Alterar depois
}

dialogModalContinueBtn.addEventListener('click', (e) => {
    e.preventDefault();

    continueFunc();

    if (timer) {
        clearInterval(timer);
    }

    dialogModalFade.classList.add('hidden');
});