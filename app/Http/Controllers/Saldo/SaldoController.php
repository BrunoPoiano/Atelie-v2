<?php

namespace App\Http\Controllers\Saldo;

use App\Http\Controllers\Controller;
use App\Models\Servicos\Servicos;
use Illuminate\Http\Request;

class SaldoController extends Controller
{
    public function saldo(Request $request)
    {
        $saldo[1]['mes'] = 'Janeiro';
        $saldo[2]['mes'] = 'Fevereiro';
        $saldo[3]['mes'] = 'Março';
        $saldo[4]['mes'] = 'Abril';
        $saldo[5]['mes'] = 'Maio';
        $saldo[6]['mes'] = 'Junho';
        $saldo[7]['mes'] = 'Julho';
        $saldo[8]['mes'] = 'Agosto';
        $saldo[9]['mes'] = 'Setembro';
        $saldo[10]['mes'] = 'Outubro';
        $saldo[11]['mes'] = 'Novembro';
        $saldo[12]['mes'] = 'Dezembro';
        for ($i = 1; $i < 10; $i++) {
            $saldo[$i]['recebido'] = Servicos::where('data', '>=', $request->ano . '-' . '0' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . '0' . $i . '-' . '31')
                ->where('pago', true)
                ->sum('valor');
            $saldo[$i]['devendo'] = Servicos::where('data', '>=', $request->ano . '-' . '0' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . '0' . $i . '-' . '31')
                ->where('pago', false)
                ->sum('valor');
        }
        for ($i = 10; $i < 13; $i++) {
            $saldo[$i]['recebido'] = Servicos::where('data', '>=', $request->ano . '-' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . $i . '-' . '31')
                ->where('pago', true)
                ->sum('valor');
                $saldo[$i]['devendo'] = Servicos::where('data', '>=', $request->ano . '-' . $i . '-' . '01')
                ->where('data', '<=', $request->ano . '-' . $i . '-' . '31')
                ->where('pago', false)
                ->sum('valor');
        }

        
        return $saldo;
    }
}
