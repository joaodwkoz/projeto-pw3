const modal = document.querySelector('#review-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const usuarioSpan = document.querySelector('.data.usuario');
const filmeSpan = document.querySelector('.data.filme');
const stars = document.querySelectorAll('.data .star');
const comentarioSpan = document.querySelector('.data.comentario');

let avaliacaoId = -1;

const verBtns = document.querySelectorAll('.action-btn.ver');
const deletarBtns = document.querySelectorAll('.action-btn.excluir');
const reativarBtns = document.querySelectorAll('.action-btn.reativar');

const imgsUrl = document.querySelector('#avaliacoes').dataset.imgsUrl;