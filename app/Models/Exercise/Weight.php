<?php

namespace App\Models\Exercise;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weight extends Model
{
    use HasFactory;

    protected $connection = 'exercise_mysql';

    protected $table = "weight";

    protected $fillable = ['weight'];

}
