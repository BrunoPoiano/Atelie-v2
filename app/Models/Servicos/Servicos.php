<?php

namespace App\Models\Servicos;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicos extends Model
{
    use HasFactory;
    protected $fillable = ['cliente_id', 'valor', 'pago', 'servico'];
}
