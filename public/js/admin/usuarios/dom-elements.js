const modal = document.querySelector('#user-modal-fade');
const modalCloseBtn = modal.querySelector('.modal-header-close');
const modalBtns = modal.querySelector('.modal-btns');
const modalTitle = modal.querySelector('.modal-title');

const nomeInput = document.querySelector('input[name="nome"]');
const emailInput = document.querySelector('input[name="email"]');
const tipoInputs = document.querySelectorAll('input[name="ehAdmin"]');

let usuarioId = -1;

let mode = 0;

/* 

0: Criação
1: Edição
2: Leitura

*/

const imgsUrl = document.querySelector('#usuarios').dataset.imgsUrl;

const inputImagem = document.querySelector('#change-img-btn');
const previewImagem = document.querySelector('.img-preview img');

const verBtns = document.querySelectorAll('.action-btn.ver');
const editarBtns = document.querySelectorAll('.action-btn.editar');
const deletarBtns = document.querySelectorAll('.action-btn.excluir');
const reativarBtns = document.querySelectorAll('.action-btn.reativar');

const saveUserBtn = document.querySelector('#save-user-btn');
const cancelUserBtn = document.querySelector('#cancel-user-btn');
const addUserBtn = document.querySelector('#user-add-btn');