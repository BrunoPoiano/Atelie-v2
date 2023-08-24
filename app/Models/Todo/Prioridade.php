<?php

namespace App\Models\Todo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prioridade extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];
}
