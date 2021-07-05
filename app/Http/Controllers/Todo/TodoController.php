<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo\Afazer;
use App\Models\Todo\Prioridade;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function store(Request $request)
    {
        if ($request) {
            $request->validate([
                'afazer' => 'required',
                'prioridade' => 'required',
            ]);
            $afazer = new Afazer([
                'afazer' => $request->afazer,
                'prioridade' => $request->prioridade,
            ]);
            $afazer->save();
            return 'Afazer Salvo com Sucesso';
        }
        return 'erro';
    }

    public function getprioridades()
    {
        return Prioridade::get();
    }

    public function getafazeres()
    {
        $afazeres = Afazer::join('prioridades', 'prioridades.id', 'afazers.prioridade')
            ->where('afazers.finalizado', false)
            ->orderby('afazers.prioridade', 'asc')->get(['afazers.*', 'prioridades.nome']);

        return $afazeres;
    }

    public function getafazeresfinalizados()
    {
        $afazeres = Afazer::join('prioridades', 'prioridades.id', 'afazers.prioridade')
            ->where('afazers.finalizado', true)
            ->orderby('afazers.prioridade', 'asc')->get(['afazers.*', 'prioridades.nome']);

        return $afazeres;
    }

    public function delete($id)
    {
        $del = Afazer::find($id);
        $del->delete();
        return 'Afazer Deletado com sucesso';
    }

    public function update($id)
    {
        $up = Afazer::find($id);
        $up->finalizado = !$up->finalizado;
        $up->update();
        return $up;
    }
}
