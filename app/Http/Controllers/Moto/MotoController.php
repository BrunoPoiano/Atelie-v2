<?php

namespace App\Http\Controllers\Moto;

use App\Http\Controllers\Controller;
use App\Models\Moto\Motokm;
use Illuminate\Http\Request;

class MotoController extends Controller
{

  public function getKms(request $request)
  {

    $user = $request->user();

    $list = Motokm::where('user_id', $user->id)
      ->orderby('id', 'desc');

    $perPage = $request->per_page ?? 10;
    $page = $request->current_page ?? 1;

    $list = $list->paginate($perPage, ['*'], 'page', $page);

    return response($list, 200);
  }

  public function createKms(Request $request)
  {
    $request->validate([
      'km' => 'required',
      'liters' => 'required',
    ]);

    $user = $request->user();

    Motokm::create([
      'user_id' => $user->id,
      'km' => $request->km,
      'liters' => $request->liters,
    ]);

    return response([], 200);
  }

  public function editKms(Request $request, Motokm $km)
  {

    $request->validate([
      'km' => 'required',
      'liters' => 'required',
    ]);

    $km->update([
      'km' => $request->km,
      'liters' => $request->liters,
    ]);

    return response([], 200);
  }

  public function deleteKms(Request $request, Motokm $km)
  {

    $km->delete();

    return response([], 200);
  }

}
