<?php

namespace App\Http\Controllers\Exercise;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercise\Weight;

class WeightController extends Controller
{
  public function getWeight(request $request)
  {

    $Weight = Weight::orderby('id', 'desc');

    $perPage = $request->per_page ?? 10;
    $page = $request->current_page ?? 1;

    $Weight = $Weight->paginate($perPage, ['*'], 'page', $page);

    return response($Weight, 200);
  }

  public function createWeight(Request $request)
  {

    $request->validate([
      'weight' => 'required'
    ]);

    $user = $request->user();

    Weight::create([
      'user_id' => $user->id,
      'weight' => $request->weight,
    ]);

    return response([], 200);
  }

  public function editWeight(Request $request, Weight $weight)
  {

    $request->validate([
      'weight' => 'required'
    ]);

    $weight->update([
      'weight' => $request->weight
    ]);

    return response([], 200);
  }

  public function deleteWeight(Request $request, Weight $weight)
  {

    $weight->delete();

    return response([], 200);
  }
}
