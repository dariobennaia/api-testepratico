<?php

namespace Tests\Feature\Refrigerantes;

use App\LitragensRefrigerantes;
use App\Refrigerantes;
use App\TiposRefrigerantes;
use Tests\TestCase;

class EdicaoTest extends TestCase
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

    public function excluirRefrigerante($id)
    {
        \DB::table('refrigerantes')->where('id_refrigerante', $id)->delete();
    }

    public function testEdicaoDeRefrigeranteComDadosValidos()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }

    public function testEdicaoDeRefrigeranteComDadosVazios()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            [],
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }

    public function testEdicaoDeRefrigeranteComInformacoesDuplicadas()
    {
        $dadosRefrigerante1 = $this->dadosValidos();
        $idRefrigerante1 = $this->cadastroDeRefrigerante($dadosRefrigerante1);

        $dadosRefrigerante2 = $this->dadosValidos();
        $dadosRefrigerante2['sabor'] = 'uva-teste-unit-2';
        $dadosRefrigerante2['marca'] = 'frevo-teste-unit-2';
        $idRefrigerante2 = $this->cadastroDeRefrigerante($dadosRefrigerante2);

        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante2}",
            $dadosRefrigerante1,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante1);
        $this->excluirRefrigerante($idRefrigerante2);
    }

    public function testEdicaoDeRefrigeranteComValorUnitarioAlfaNumerico()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['valor'] = 'asd';

        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }

    public function testEdicaoDeRefrigeranteComValorUnitarioDecimalInvalido()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['valor'] = '1000000,00';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dadosRefrigerante['valor'] = '1.000000,00';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dadosRefrigerante['valor'] = '1,000000.00';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dadosRefrigerante['valor'] = '999999999999.00';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }

    public function testEdicaoDeRefrigeranteComValorDeEstoqueAlfaNumerico()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);
        $dadosRefrigerante['estoque'] = 'asd';

        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }

    public function testEdicaoDeRefrigeranteComValorDeEstoqueInvalido()
    {
        $dadosRefrigerante = $this->dadosValidos();
        $idRefrigerante = $this->cadastroDeRefrigerante($dadosRefrigerante);

        $dadosRefrigerante['estoque'] = '-100';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dadosRefrigerante['estoque'] = '10a';
        $request = $this->patch(
            "/api/refrigerantes/{$idRefrigerante}",
            $dadosRefrigerante,
            ['Accept' => 'application/json']
        );
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $this->excluirRefrigerante($idRefrigerante);
    }
}
