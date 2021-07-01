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

    public function getServico(Request $request)
    {
        if ($request) {

            $key = trim($request->get('cliente'));
            $dtinicio = new Carbon($request->datainicial);
            $dtfinal = new Carbon($request->datafinal . ' 23:59:59');

            $servicos = Servicos::join('clientes', 'clientes.id', 'servicos.cliente_id')
                ->where('clientes.nome', 'like', "%{$key}%")
                ->where('servicos.data', '>=', $dtinicio)
                ->where('servicos.data', '<=', $dtfinal)
                ->orderby('servicos.data', 'asc');

            if ($request->pago == 'null') {
                return $servicos->get(['servicos.*', 'clientes.nome']);

            } elseif ($request->pago == 0) {
                $servicos->where('servicos.pago', false);
            } else {
                $servicos->where('servicos.pago', true);
            }
            return $servicos->get(['servicos.*', 'clientes.nome']);

        }
        return 'Erro ao receber dados';
    }
}
