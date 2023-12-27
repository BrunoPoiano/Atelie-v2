<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class MigrationTest extends TestCase
{
    public function testCriarClientesTable()
    {
        $this->assertTrue(
            Schema::hasTable('clientes')
        );
    }

    public function testClientesTableColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('clientes', [
                'id',
                'nome',
                'telefone',
                'detalhes',
                'created_at',
                'updated_at',
            ])
        );
    }

    public function testCriarServicosTable()
    {
        $this->assertTrue(
            Schema::hasTable('servicos')
        );
    }

    public function testServicosTableColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('servicos', [
                'id',
                'cliente_id',
                'valor',
                'gastos',
                'pago',
                'data',
                'servico',
                'deleted_at',
                'created_at',
                'updated_at',
            ])
        );
    }

    public function testCriarAfazeresTable()
    {
        $this->assertTrue(
            Schema::hasTable('clientes')
        );
    }

    public function testAfazeresTableColumns()
    {
        $this->assertTrue(
            Schema::hasColumns('afazers', [
                'id',
                'prioridade',
                'afazer',
                'finalizado',
                'created_at',
                'updated_at',
            ])
        );
    }

    
}
