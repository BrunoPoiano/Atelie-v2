<?php

namespace Database\Seeders;

use App\Models\Cliente\Cliente;
use Illuminate\Database\Seeder;

class ClientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Cliente::factory()->count(10)->create();
    }
}
