<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index() {
        $Clientes = Cliente::all();
        $clientesComImagem = $Clientes->map(function($Cliente){
            return [
                'nome' => $Cliente->nome,
                'endereco' => $Cliente->endereco,
                'telefone' => $Cliente->telefone,
                'email' => $Cliente->email,
                'cpf' => $Cliente->cpf,
                'password' => $Cliente->password,
                'imagem' => asset('storage/' . $Cliente->imagem)

            ];
        });
        return response()->json($clientesComImagem);
    }
    public function store(Request $request){

        $clienteData = $request->all();

        if($request->hasFile('imagem')){
            $imagem = $request->file('imagem');
            $nomeImagem = time().'.'.$imagem->getClientOriginalExtension();
            $caminhoImagem = $imagem->storeAs('imagem/clientes', $nomeImagem, 'public');
            $clienteData['imagem'] = $caminhoImagem;
        }
        $Cliente = Cliente::create($clienteData);
        return response()->json(['Cliente'=>$Cliente],201);
    }
}
