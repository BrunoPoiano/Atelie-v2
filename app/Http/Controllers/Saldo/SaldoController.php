<?php

namespace App\Http\Controllers\Saldo;

use App\Http\Controllers\Controller;
use App\Models\Servicos\Servicos;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function saldo(Request $request)
    {
        $mensal[1]['mes'] = 'Janeiro';
        $mensal[2]['mes'] = 'Fevereiro';
        $mensal[3]['mes'] = 'Março';
        $mensal[4]['mes'] = 'Abril';
        $mensal[5]['mes'] = 'Maio';
        $mensal[6]['mes'] = 'Junho';
        $mensal[7]['mes'] = 'Julho';
        $mensal[8]['mes'] = 'Agosto';
        $mensal[9]['mes'] = 'Setembro';
        $mensal[10]['mes'] = 'Outubro';
        $mensal[11]['mes'] = 'Novembro';
        $mensal[12]['mes'] = 'Dezembro';
        $anual['positivo'] = 0;
        $anual['negativo'] = 0;
        for ($i = 1; $i < 10; $i++) {
            $mensal[$i]['recebido'] = Servicos::where('data', '>=', $request->ano . '-' . '0' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . '0' . $i . '-' . '31')
                ->where('pago', true)
                ->sum('valor');
            $mensal[$i]['devendo'] = Servicos::where('data', '>=', $request->ano . '-' . '0' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . '0' . $i . '-' . '31')
                ->where('pago', false)
                ->sum('valor');
            $anual['positivo'] += $mensal[$i]['recebido'];
            $anual['negativo'] += $mensal[$i]['devendo'];
        }
        for ($i = 10; $i < 13; $i++) {
            $mensal[$i]['recebido'] = Servicos::where('data', '>=', $request->ano . '-' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . $i . '-' . '31')
                ->where('pago', true)
                ->sum('valor');
            $mensal[$i]['devendo'] = Servicos::where('data', '>=', $request->ano . '-' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . $i . '-' . '31')
                ->where('pago', false)
                ->sum('valor');
            $anual['positivo'] += $mensal[$i]['recebido'];
            $anual['negativo'] += $mensal[$i]['devendo'];
        }

        $hoje = Servicos::where('data', '>=', Carbon::today()->toDateString().' 00:00:00')
        ->where('data', '<=', Carbon::today()->toDateString().' 23:59:59')
        ->where('pago', true)
        ->sum('valor');

        return ['mensal' => $mensal, 'anual' => $anual, 'hoje'=>$hoje];
    }
}
