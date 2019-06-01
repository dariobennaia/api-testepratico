<?php

namespace Tests\Feature\Refrigerantes;

use App\LitragensRefrigerantes;
use App\Refrigerantes;
use App\TiposRefrigerantes;
use Tests\TestCase;

class CadastroTest extends TestCase
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

    public function testCadastroRefrigeranteInexistente()
    {
        $request = $this->post('/api/refrigerantes', $this->dadosValidos(), ['Accept' => 'application/json']);
        $request->assertStatus(200);
        $this->assertTrue($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteExistente()
    {
        $request = $this->post('/api/refrigerantes', $this->dadosValidos(), ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteComDadosVazios()
    {
        $request = $this->post('/api/refrigerantes', [], ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteComValorUnitarioAlfaNumerico()
    {
        $dados = $this->dadosValidos();
        $dados['valor'] = 'asd';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteComValorUnitarioDecimalInvalido()
    {
        $dados = $this->dadosValidos();

        $dados['valor'] = '1000000,00';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dados['valor'] = '1.000000,00';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dados['valor'] = '1,000000.00';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dados['valor'] = '999999999999.00';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteComValorDeEstoqueAlfaNumerico()
    {
        $dados = $this->dadosValidos();
        $dados['estoque'] = 'asd';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testCadastroRefrigeranteComValorDeEstoqueInvalido()
    {
        $dados = $this->dadosValidos();

        $dados['estoque'] = '-100';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());

        $dados['estoque'] = '10a';
        $request = $this->post('/api/refrigerantes', $dados, ['Accept' => 'application/json']);
        $request->assertStatus(422);
        $this->assertFalse($request->isOk());
        $this->assertIsObject($request);
        $this->assertEquals('application/json', $request->headers->get('Content-Type'));
        $this->assertJson($request->getContent());
    }

    public function testExcluirCadastroRefrigerante()
    {
        Refrigerantes::where('sabor', $this->dadosValidos()['sabor'])
            ->where('marca', $this->dadosValidos()['marca'])
            ->delete();
        $this->assertTrue(true);
    }
}
