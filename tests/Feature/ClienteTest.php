<?php

namespace Tests\Feature;

use App\Models\Cliente\Cliente;
use Tests\TestCase;

class ClienteTest extends TestCase
{
    public function testClienteStore()
    {
        $cliente = [
            'nome' => 'Cliente Store Test',
            'telefone' => 12345,
            'detalhes' => 'Cliente Store Test',
        ];
        $this->post('clientes', $cliente)
            ->assertStatus(200);

        $this->assertDatabaseHas('clientes', [
            'nome' => 'Cliente Store Test',
            'telefone' => 12345,
            'detalhes' => 'Cliente Store Test',
        ]);
    }

    public function testServicoUpdate()
    {
        $cliente = Cliente::factory()->create();

        $this->put('clientes/' . $cliente->id, [
            'nome' => 'Cliente Update Test',
            'telefone' => 12345,
            'detalhes' => 'Cliente Update Test',
        ])->assertStatus(200);

        $this->assertDatabaseHas('clientes', [
            'nome' => 'Cliente Update Test',
            'telefone' => 12345,
            'detalhes' => 'Cliente Update Test',
        ]);
    }

    public function testClienteDelete()
    {
        $cliente = Cliente::factory()->create();
        $this->delete('clientes/' . $cliente->id)
            ->assertStatus(200);
    }

    public function testGetClientes()
    {
        $this->post('clientes/getClientes', ['cliente' => ''])
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => ['id', 'nome', 'telefone', 'detalhes'],
            ]);

    }
}
