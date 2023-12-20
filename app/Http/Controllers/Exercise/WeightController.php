<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise\Weight;

class WeightController extends Controller
{
    public function getWeight(request $request){

        $Weight = Weight::orderby('id', 'desc');

        $perPage = $request->per_page ?? 10;
        $page = $request->current_page ?? 1;
    
        $Weight = $Weight->paginate($perPage, ['*'], 'page', $page);
    
        return response($Weight, 200);
    }

}
