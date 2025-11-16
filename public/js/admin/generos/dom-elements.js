const modal = document.querySelector('#genre-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const nomeInput = document.querySelector('input[name="nome"]');
const corInput = document.querySelector('input[name="cor"]');
const filmeGroup = document.querySelector('.form-group.filmes');
const moviesList = filmeGroup.querySelector('.movies-list');
const corSelector = document.querySelector('.cor-container .selector');

let generoId = -1;

let mode = 0;

/* 

0: Criação
1: Edição
2: Leitura

*/

const imgsUrl = document.querySelector('main').dataset.imgsUrl;
const storageUrl = document.querySelector('main').dataset.storageUrl;

const verBtns = document.querySelectorAll('.action-btn.ver');
const editarBtns = document.querySelectorAll('.action-btn.editar');
const deletarBtns = document.querySelectorAll('.action-btn.excluir');
const reativarBtns = document.querySelectorAll('.action-btn.reativar');

const saveGenreBtn = document.querySelector('#save-genre-btn');
const cancelGenreBtn = document.querySelector('#cancel-genre-btn');
const addGenreBtn = document.querySelector('#genre-add-btn');