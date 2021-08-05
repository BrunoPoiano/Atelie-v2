<?php

namespace Tests\Feature;

use App\Models\Servicos\Servicos;
use Carbon\Carbon;
use Tests\TestCase;

class ServicoTest extends TestCase
{
    public function testServicoStore()
    {
        $data = Carbon::now();
        $created_at = Carbon::now();
        $updated_at = Carbon::now();

        $servico = [
            'cliente_id' => 2,
            'valor' => 50,
            'gastos' => 10,
            'data' => $data,
            'pago' => true,
            'servico' => 'Test Servico Store',
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ];
        $this->post('servicos', $servico)
            ->assertStatus(200);

        $this->assertDatabaseHas('servicos', [
            'cliente_id' => 2,
            'valor' => 50,
            'gastos' => 10,
            'data' => $data,
            'pago' => true,
            'servico' => 'Test Servico Store',
            'created_at' => $created_at,
            'updated_at' => $updated_at,
        ]);
    }

    public function testServicoUpdate()
    {
        $servico = Servicos::factory()->create();

        $this->put('servicos/' . $servico->id, [
            'preco' => 500,
            'pago' => true,
            'servico' => 'Test Servico Update',
            'data' => $servico->data,
            'gastos' => 100,
        ])->assertStatus(200);

        $this->assertDatabaseHas('servicos', [
            "id" => $servico->id,
            "cliente_id" => $servico->cliente_id,
            "valor" => 500,
            "gastos" => 100,
            "pago" => true,
            "data" => $servico->data,
            "servico" => 'Test Servico Update',
        ]);
    }

    public function testGetServico()
    {
        $servico = [
            'datainicial' => '2021-01-01',
            'datafinal' => '2021-12-31',
            'pago' => 'null',
            'cliente' => '',
        ];
        $this->post('servicos/getServico', $servico)
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'cliente_id', 'data', 'nome', 'valor', 'gastos', 'pago', 'servico', 'created_at', 'updated_at'],
            ]);

    }

    public function testServicoDelete()
    {
        $servico = Servicos::factory()->create();

        $this->delete('servicos/' . $servico->id)
            ->assertStatus(200);

    }
}
