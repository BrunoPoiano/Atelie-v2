<?php

namespace App\Http\Controllers\Servico;

use App\Http\Controllers\Controller;
use App\Models\Servicos\Servicos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicoController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
    }

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
                'gastos' => $request->gastos,
                'pago' => $request->pago,
                'data' => $data,
                'servico' => $request->servico,
            ]);
            $novoServico->save();
            return 'Servico Salvo com sucesso';
        }
        return 'Erro ao receber Dados';
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        if ($request) {
            $request->validate([
                'valor' => 'numeric',
                'data' => 'date|required',
                'servico' => 'nullable',
            ]);
            $upServico = Servicos::find($id);
            $upServico->valor = $request->preco;
            $upServico->pago = $request->pago;
            $upServico->servico = $request->servico;
            $upServico->data = $request->data;
            $upServico->gastos = $request->gastos;
            $upServico->save();
            return 'Servico Atualizado com sucesso';
        }
        return 'erro ao receber dados';
    }

    public function destroy($id)
    {
        $delServico = Servicos::find($id);
        if ($delServico) {
            $delServico->delete();
            return 'Serviço Deletado com sucesso';
        }
        return 'Serviço não encontrado';
    }

    public function getServico(Request $request)
    {
        if ($request) {

            $key = trim($request->get('cliente'));
            $dtinicio = new Carbon($request->datainicial . '00:00:00');
            $dtfinal = new Carbon($request->datafinal . ' 23:59:59');

            $servicos = Servicos::join('clientes', 'clientes.id', 'servicos.cliente_id')
                ->where('clientes.nome', 'like', "%{$key}%")
                ->where('servicos.data', '>=', $dtinicio)
                ->where('servicos.data', '<=', $dtfinal)
                ->orderby('servicos.data', 'Asc');

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
