<?php

namespace App\Models\Moto;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motokm extends Model
{
  use HasFactory;

  protected $connection = 'exercise_mysql';

  protected $table = "motokms";

  protected $fillable = [
    'user_id',
    'km',
    'liters',
  ];
}
