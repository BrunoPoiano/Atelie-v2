<?php

namespace Tests\Feature;

use Tests\TestCase;

class ServicosTest extends TestCase
{

/*    public function testStore()
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
 */
    public function testGetServico()
    {

        $servico = [
            'datainicial' => '2021-01-01',
            'datafinal' => '2021-07-12',
            'pago' => 'null',
            'cliente' => '',
        ];
       $response =  $this->post('servicos/getServico', $servico)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'cliente_id', 'data', 'nome', 'valor', 'gastos', 'pago', 'servico', 'created_at', 'updated_at']
            ]);
            $array = json_decode($response->getContent());

            dd($array);
    }
}
