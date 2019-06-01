<?php

namespace Tests\Feature\Refrigerantes;

use App\LitragensRefrigerantes;
use App\Refrigerantes;
use App\TiposRefrigerantes;
use Tests\TestCase;

class ListagemTest extends TestCase
{
    /**
     * @return array
     */
    private function dadosValidos()
    {
        $idTipoRefrigerante = TiposRefrigerantes::first()->id_tipo_refrigerante;
        $idLitragemRefrigerante = LitragensRefrigerantes::first()->id_litragem_refrigerante;
        return [
            'id_tipo_refrigerante'  => $idTipoRefrigerante,
            'id_litragem_refrigerante'  => $idLitragemRefrigerante,
            'sabor'  => 'uva-teste-unit',
            'marca'  => 'Frevo-teste-unit',
            'valor'  => '10000.20',
            'estoque'  => '20'
        ];
    }

    public function cadastroDeRefrigerante($dados)
    {
        $refrigerante = Refrigerantes::create($dados);
        return $refrigerante->id_refrigerante;
    }

    public function deleteRefrigerante($id)
    {
        Refrigerantes::find($id)->delete();
    }

    public function testListagemDeRefrigerantesExistente()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->get(
            "/api/refrigerantes/{$idRefrigerante}",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->deleteRefrigerante($idRefrigerante);
    }

    public function testListagemDeRefrigerantesPorPaginacao()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->get(
            "/api/refrigerantes/paginacao",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->deleteRefrigerante($idRefrigerante);
    }

    public function testListagemDeRefrigerantesPorPaginacaoEQuantidadeDePaginas()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->get(
            "/api/refrigerantes/paginacao/2",
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->deleteRefrigerante($idRefrigerante);
    }
}
