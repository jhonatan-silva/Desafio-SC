<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\ListaDeDivida;
use App\Repositories\ApiRepository;
use App\Usuario;

class ApiController extends Controller
{
    protected $apiRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(ApiRepository $apiRepository)
    {
        $this->apiRepository = $apiRepository;
    }

    public function syncBases()
    {
        $this->syncBaseA();
        $this->syncBaseB();
        $this->syncBaseC();

        return response()->json(['success' => true], 200);
    }

    public function syncBaseA()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/a.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $base_a = $this->apiRepository->connect($uri, $headers);

        foreach ($base_a as $item) {
            $endereco = $item['endereco'];
            $lista_de_dividas = $item['lista_de_dividas'];

            $endereco_usuario = Endereco::updateOrCreate([
                'cep' => $endereco['cep'],
                'logradouro' => $endereco['logradouro'],
                'bairro' => $endereco['bairro'],
                'cidade' => $endereco['cidade'],
                'uf' => $endereco['uf']
            ]);

            $usuario = Usuario::updateOrCreate(
                [
                    'cpf' => $item['cpf'],
                ],
                [
                    'endereco_id' => $endereco_usuario->id,
                    'nome' => $item['nome'],
                    'cpf' => $item['cpf']
                ]);

            foreach ($lista_de_dividas as $lista_de_divida) {
                ListaDeDivida::updateOrCreate(
                    [
                        'usuario_id' => $usuario->id,
                        'descricao' => $lista_de_divida['descricao']
                    ],
                    [
                        'usuario_id' => $usuario->id,
                        'descricao' => $lista_de_divida['descricao'],
                        'valor' => $lista_de_divida['valor']
                    ]);
            }
        }
    }

    public function syncBaseB()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/b.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        return $this->apiRepository->connect($uri, $headers);
    }

    public function syncBaseC()
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/c.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        return $this->apiRepository->connect($uri, $headers);
    }
}
