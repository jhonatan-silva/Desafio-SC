<?php

namespace App\Http\Controllers;

use App\Endereco;
use App\FonteDeRenda;
use App\ListaDeBem;
use App\ListaDeDivida;
use App\MovimentacaoFinanceira;
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

        $usuarios = Usuario::get();

        $this->syncBaseB($usuarios);
        $this->syncBaseC($usuarios);

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

            foreach ($item['lista_de_dividas'] as $lista_de_divida) {
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

    public function syncBaseB($usuarios)
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/b.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $base_b = $this->apiRepository->connect($uri, $headers);

        foreach ($usuarios as $usuario) {
            if (isset($base_b[$usuario->cpf])) {
                $item = $base_b[$usuario->cpf];

                $usuario->update(['idade' => $item['idade']]);

                foreach ($item['lista_de_bens'] as $lista_de_bem) {
                    ListaDeBem::updateOrCreate(
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $lista_de_bem['descricao']
                        ],
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $lista_de_bem['descricao'],
                            'valor' => $lista_de_bem['valor']
                        ]);
                }

                foreach ($item['fontes_de_rendas'] as $fonte_de_renda) {
                    FonteDeRenda::updateOrCreate(
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $fonte_de_renda['descricao']
                        ],
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $fonte_de_renda['descricao'],
                            'valor' => $fonte_de_renda['valor']
                        ]);
                }
            }
        }

    }

    public function syncBaseC($usuarios)
    {
        $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/c.json';
        $headers = [
            'Content-Type' => 'application/json',
        ];

        $base_c = $this->apiRepository->connect($uri, $headers);

        foreach ($usuarios as $usuario) {
            if (isset($base_c[$usuario->cpf])) {
                $item = $base_c[$usuario->cpf];

                $usuario->update(['ultima_consulta_cpf' => $item['ultima_consulta_cpf']]);

                foreach ($item['movimentacoes_financeiras'] as $lista_de_bem) {
                    MovimentacaoFinanceira::updateOrCreate(
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $lista_de_bem['descricao']
                        ],
                        [
                            'usuario_id' => $usuario->id,
                            'descricao' => $lista_de_bem['descricao'],
                            'valor' => $lista_de_bem['valor']
                        ]);
                }
            }
        }
    }
}
