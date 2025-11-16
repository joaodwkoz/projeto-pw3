const modal = document.querySelector('#contact-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const nomeSpan = document.querySelector('.data.nome');
const emailSpan = document.querySelector('.data.email');
const assuntoSpan = document.querySelector('.data.assunto');
const mensagemSpan = document.querySelector('.data.mensagem');

let avaliacaoId = -1;

const verBtns = document.querySelectorAll('.action-btn.ver');
const resolverBtns = document.querySelectorAll('.action-btn.resolver');
const naoResolverBtns = document.querySelectorAll('.action-btn.nao-resolver');

const imgsUrl = document.querySelector('#contatos').dataset.imgsUrl;