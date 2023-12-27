<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
  public function createUsers(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required',
    ]);

    if ($validator->fails()) {
      return response(['errors' => $validator->errors(), 500]);
    }

    User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => bcrypt($request->password),
    ]);

    return response([], 200);
  }

  public function updateUser(Request $request, User $user)
  {
    $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
    ]);

    $user->name = $request->filled('name') ? $request->name : $user->name;
    $user->email = $request->filled('email') ? $request->email : $user->email;

    if ($request->filled('password')) {
      $user->password = bcrypt($request->password);
    }

    $user->save();

    return response([], 200);
  }

  public function login(Request $request)
  {
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $user = $request->user();
      $client = $user->createToken('MyApp');
      $accessToken = $client->accessToken;

      \Log::info($client); // Check the client instance
      \Log::info($accessToken); // Check the access token
  
      return response()->json(['token' => $accessToken]);
    }

    return response(['error' => 'Error authentication'], 500);
  }

  public function checkAuth(Request $request)
  {
    return 'aqui';
  }
}
