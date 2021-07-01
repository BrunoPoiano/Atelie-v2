<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use App\Models\Servicos\Servicos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicoController extends Controller
{

    public function store(Request $request)
    {       
                if ($request) {
            $request->validate([
                'cliente_id' => 'required|numeric',
                'valor' => 'numeric',
            ]);
            $data = new Carbon($request->data);
            $novoServico = new Servicos([
                'cliente_id' => $request->cliente_id,
                'valor' => $request->valor,
                'pago' => $request->pago,
                'data' => $data,
                'servico' => $request->servico,
            ]);
            $novoServico->save();
            return 'Servico Salvo com sucesso';
        }
        return 'Erro ao receber Dados';
    }

    public function update(Request $request, $id)
    {
        if ($request) {
            $request->validate([
                'valor' => 'numeric',
                'created_at' => 'date|required',
            ]);
            $upServico = Servicos::find($id);
            $upServico->valor = $request->valor;
            $upServico->pago = $request->pago;
            $upServico->servico = $request->servico;
            $upServico->save();
            return 'Servico Atualizado com sucesso';
        }
        return 'erro ao receber dados';
    }

    public function getServico()
    {
        return Servicos::join('clientes', 'clientes.id', 'servicos.cliente_id')
            ->orderby('updated_at', 'desc')
            ->get(['servicos.*', 'clientes.nome']);
    }
}
