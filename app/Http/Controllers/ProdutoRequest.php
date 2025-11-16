<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdutoRequest extends Controller
{
    public function store (ProdutoRequest $request) {
        $produto = newProduto();
        $produto -> produto = $request -> txProduto;
        $produto -> descrProduto = $request -> txDescrProduto;
        $produto -> valor = $request -> txValor;
        $produto -> dtCadastro ="2023-09-27";
        $produto -> save();

        //return redirect ('/produto');

        return redirect('/produto') -> with ('mensagem' , 'Produto adicionado com sucesso!');
    }
}
