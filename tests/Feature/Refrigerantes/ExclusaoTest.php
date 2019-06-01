<?php

namespace Tests\Feature\Refrigerantes;

use App\LitragensRefrigerantes;
use App\Refrigerantes;
use App\TiposRefrigerantes;
use Tests\TestCase;

class ExclusaoTest extends TestCase
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

    public function testExclusaoDeRefrigeranteExistente()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->delete(
            "/api/refrigerantes/{$idRefrigerante}",
            [],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testExclusaoDeMultiplosRefrigerantesExistentes()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante[] = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['sabor'] = 'uva-teste-unit-2';
        $dadosRefrigerante['marca'] = 'Frevo-teste-unit-2';
        $idRefrigerante[] = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['sabor'] = 'uva-teste-unit-3';
        $dadosRefrigerante['marca'] = 'Frevo-teste-unit-3';
        $idRefrigerante[] = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['sabor'] = 'uva-teste-unit-4';
        $dadosRefrigerante['marca'] = 'Frevo-teste-unit-4';
        $idRefrigerante[] = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->delete(
            "/api/refrigerantes",
            ['id_refrigerante' => $idRefrigerante],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testExclusaoDeMultiplosRefrigerantesSemIds()
    {
        $request = $this->delete(
            "/api/refrigerantes",
            [],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testExclusaoDeMultiplosRefrigerantesComIdNoFormatoInvalido()
    {
        $request = $this->delete(
            "/api/refrigerantes",
            ['id_refrigerante'],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testExclusaoDeMultiplosRefrigerantesComIdInexistente()
    {
        $request = $this->delete(
            "/api/refrigerantes",
            ['id_refrigerante' => 'a'],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $request = $this->delete(
            "/api/refrigerantes/a",
            [],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }
}
