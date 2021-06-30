<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;

class ServicosTest extends TestCase
{

    public function testStore()
    {
        $servico = [
            'cliente_id' => 2,
            'valor' => 50,
            'pago' => true,
            'servico' => 'costurar calças',
        ];
        $this->post('servicos/store', $servico)
            ->assertStatus(200);
    }

    public function testUpdate()
    {
        $servico = [
            'valor' => 500,
            'pago' => false,
            'servico' => 'costurar calças',
            'created_at' => Carbon::now(),
        ];

        $this->post('servicos/update/' . 12, $servico)
            ->assertStatus(200);
    }

    public function testGetServico()
    {
        $this->get('servicos/getServico')
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'nome', 'valor', 'pago', 'servico', 'created_at', 'updated_at'],
            ]);
    }
}
