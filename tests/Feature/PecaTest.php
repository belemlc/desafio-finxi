<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PecaTest extends TestCase
{
    protected $token;
    protected $user;
    protected const ANUNCIANTE_ID = 2;
    protected const ANUNCIANTE_ROLE = 2;

    public function setUp(): void
    {
        parent::setUp();
        /**
         * Efetua o login do usuário já criado com o papel de aununciante
         */
        $user = new User([
            'id' => self::ANUNCIANTE_ID,
            'name' => 'Anunciante',
            'email' => 'anunciante@finxi.com',
            'password' => 'admin123',
            'role_id' => self::ANUNCIANTE_ROLE
        ]);

        Passport::actingAs($user);

        $this->token = $user->createToken('token')->accessToken;
        $this->user = $user;
    }

    /**
     * Lista todos os anuncions de uma usuario com o papel de anunciante
     */
    public function test_lista_anuncions()
    {
        $response =  $this->withHeaders(['Authorization' => 'Bearer '.$this->token])
            ->json('GET', '/api/pecas');
        $response->assertOk();
    }

    /**
     * Cria um anuncio
     */
    public function test_criar_anuncio()
    {
        $response =  $this->withHeaders(['Authorization' => 'Bearer '.$this->token])
            ->json('POST', '/api/pecas', [
                'descricao' => 'Vendo um Droid R4-P17',
                'anunciante_id' => $this->user->id,
                'endereco' => [
                    'logradouro' => 'Rua Alcindo Guanabara',
                    'cep' => '20031-130',
                    'numero' => 300,
                    'bairro' => 'Centro',
                    'cidade' => 'Rio de Janeiro',
                    'estado' => 'RJ'
                ],
                'contato' => [
                    'email' => 'test@gmail.com',
                    'celular' => '(21) 9999-11299',
                    'telefone' => '(21) 2239-9302'
                ]
            ]);
        $response->assertStatus(201);
    }
}
