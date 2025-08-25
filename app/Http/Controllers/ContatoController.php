<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Contato;

class ContatoController extends Controller{

    /**
        * 
             * @return \Illuminate\Http\Response;
           
             */
        public function index()
        {
            $contatos = Contato::all();
            return view('admin.contatos')->with('contatos', $contatos);
        }

        public function storeApi(Request $request){
            $contato = new Contato();

            $contato->nome = $request->nome;
            $contato->email = $request->email;
            $contato->assunto = $request->assunto;
            $contato->mensagem = $request->mensagem;
            $contato->created_at = date('Y-m-d H:i:s');
            $contato->updated_at = date('Y-m-d H:i:s');
            
            $contato->save();
        }

        public function store(Request $request){
            $contato = new Contato();

            $contato -> nome = $request -> txNome;
            $contato -> email = $request -> txEmail;
            $contato -> assunto = $request -> txAssunto;
            $contato -> mensagem = $request -> txMensagem;
            $contato -> created_at = date('Y-m-d H:i:s');
            $contato -> update_at = date('Y-m-d H:i:s');
            
            $contato->save();
        }
    }
?>