const modal = document.querySelector('#movie-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const nomeInput = document.querySelector('input[name="nome"]');
const diretorInput = document.querySelector('input[name="diretor"]');
const lancamentoInput = document.querySelector('input[name="ano_lancamento"]');
const sinopseInput = document.querySelector('textarea[name="sinopse"]');
const trailerInput = document.querySelector('input[name="trailer"]');

let filmeId = -1;

let mode = 0;

/* 

0: Criação
1: Edição
2: Leitura

*/

const imgsUrl = document.querySelector('#filmes').dataset.imgsUrl;

const inputImagem = document.querySelector('#change-img-btn');
const previewImagem = document.querySelector('.img-preview img');

let generos = [];
const chipInputOptions = document.querySelectorAll('.option');

const dropdownSelectedOption = document.querySelector('.selected-option');
const dropdownSelectedOptionSpan = dropdownSelectedOption.querySelector('span');
const dropdownMenu = document.querySelector('.dropdown-menu');
const dropdownBtns = dropdownMenu.querySelectorAll('.dropdown-btn');

let classificacaoId = 1;

const verBtns = document.querySelectorAll('.action-btn.ver');
const editarBtns = document.querySelectorAll('.action-btn.editar');
const deletarBtns = document.querySelectorAll('.action-btn.excluir');
const reativarBtns = document.querySelectorAll('.action-btn.reativar');

const saveMovieBtn = document.querySelector('#save-movie-btn');
const cancelMovieBtn = document.querySelector('#cancel-movie-btn');
const addMovieBtn = document.querySelector('#movie-add-btn');