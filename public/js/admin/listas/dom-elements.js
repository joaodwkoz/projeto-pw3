const modal = document.querySelector('#list-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const usuarioSpan = document.querySelector('.data.usuario');
const nomeSpan = document.querySelector('.data.nome');
const descricaoSpan = document.querySelector('.data.descricao');
const filmeGroup = document.querySelector('.form-group.filmes');
const moviesList = filmeGroup.querySelector('.movies-list');

let listaId = -1;

let mode = 0;

/* 

0: Criação
1: Edição
2: Leitura

*/

const imgsUrl = document.querySelector('main').dataset.imgsUrl;
const storageUrl = document.querySelector('main').dataset.storageUrl;

const verBtns = document.querySelectorAll('.action-btn.ver');
const deletarBtns = document.querySelectorAll('.action-btn.excluir');
const reativarBtns = document.querySelectorAll('.action-btn.reativar');