<?php

namespace App\Http\Controllers\Cliente;

use App\Http\Controllers\Controller;
use App\Models\Cliente\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function store(Request $request)
    {

        if ($request) {
            $request->validate([
                'nome' => 'required',
                'telefone' => 'numeric',
            ]);
            $novoCliente = new Cliente([
                'nome' => $request->nome,
                'telefone' => $request->telefone,
                'detalhes' => $request->detalhes,
            ]);
            $novoCliente->Save();
            return 'cliente salvo com sucesso';

        }
        return 'Erro ao Receber Informações sobre Cliente';
    }

    public function getClientes(Request $request)
    {
        $key = trim($request->get('cliente'));

        

        return Cliente::orderby('created_at', 'Desc')
            ->where('nome', 'like', "%{$key}%")
            ->get();
    }

    public function apagar($id)
    {
        if ($id) {
            $apagarCliente = Cliente::find($id);
            if ($apagarCliente) {
                $apagarCliente->delete();
                return 'Cliente apagado com sucesso';
            }
            return 'Cliente não encontrado';
        }
        return "Erro ao Receber Informações";
    }

    public function editar(Request $request, $id)
    {
        if ($request && $id) {
            $request->validate([
                'nome' => 'required',
                'telefone' => 'numeric',
            ]);
            $editarCliente = Cliente::find($id);
            if ($editarCliente) {
                $editarCliente->nome = $request->nome;
                $editarCliente->telefone = $request->telefone;
                $editarCliente->detalhes = $request->detalhes;
                $editarCliente->update();
                return 'Cliente editado com sucesso';
            }
            return 'Cliente Não encontrado';
        }
        return 'Erro ao receber dados';
    }

}
