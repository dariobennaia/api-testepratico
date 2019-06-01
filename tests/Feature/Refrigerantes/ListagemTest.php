<?php

namespace Tests\Feature\Refrigerantes;

use Tests\TestCase;

class ListagemTest extends TestCase
{
    public function testListagemDeRefrigerantesExistente()
    {
        $request = $this->get(
            "/api/refrigerantes/1",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testListagemDeRefrigerantesPorPaginacao()
    {
        $request = $this->get(
            "/api/refrigerantes/paginacao",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testListagemDeRefrigerantesPorPaginacaoEQuantidadeDePaginas()
    {
        $request = $this->get(
            "/api/refrigerantes/paginacao/2",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }
}
