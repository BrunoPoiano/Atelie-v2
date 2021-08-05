<?php

namespace Database\Seeders;

use App\Models\Servicos\Servicos;
use Illuminate\Database\Seeder;

class ServicosSeeder extends Seeder
{
   
    public function run()
    {
        
        Servicos::factory()->count(10)->create();
    }
}
