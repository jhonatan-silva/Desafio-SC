<?php

namespace App\Http\Controllers;

use App\DadosUltimaCompraCartaoCredito;
use App\Endereco;
use App\FonteDeRenda;
use App\ListaDeBem;
use App\ListaDeDivida;
use App\MovimentacaoFinanceira;
use App\Repositories\ApiRepository;
use App\Usuario;
use Illuminate\Support\Facades\DB;

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
        $sync_base_a = $this->syncBaseA();

        if (!$sync_base_a['success']) {
            return response()->json(['success' => false, 'message' => $sync_base_a['message']]);
        }

        $usuarios = Usuario::get();

        $sync_base_b = $this->syncBaseB($usuarios);

        if (!$sync_base_b['success']) {
            return response()->json(['success' => false, 'message' => $sync_base_b['message']]);
        }

        $sync_base_c = $this->syncBaseC($usuarios);

        if (!$sync_base_c['success']) {
            return response()->json(['success' => false, 'message' => $sync_base_c['message']]);
        }

        return response()->json(['success' => true, 'message' => 'Sucesso']);
    }

    public function syncBaseA()
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/a.json';
            $headers = [
                'Content-Type' => 'application/json',
//                'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
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
            DB::commit();

            return ['success' => true, 'message' => 'Sucesso'];
        } catch (\Exception $exception) {
            DB::rollback();

            return ['success' => false, 'message' => $exception->getMessage() . ' na linha: ' . $exception->getLine()];
        }
    }

    public function syncBaseB($usuarios)
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/b.json';
            $headers = [
                'Content-Type' => 'application/json',
//                'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
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
            DB::commit();

            return ['success' => true, 'message' => 'Sucesso'];
        } catch (\Exception $exception) {
            DB::rollback();

            return ['success' => false, 'message' => $exception->getMessage() . ' na linha: ' . $exception->getLine()];
        }
    }

    public function syncBaseC($usuarios)
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/c.json';
            $headers = [
                'Content-Type' => 'application/json',
//                'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
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

                    $dados_ultima_compra_cartao_credito = $item['dados_ultima_compra_cartao_credito'];

                    DadosUltimaCompraCartaoCredito::updateOrCreate(
                        [
                            'usuario_id' => $usuario->id,
                            'bandeira' => $dados_ultima_compra_cartao_credito['bandeira'],
                            'numero' => $dados_ultima_compra_cartao_credito['numero'],
                        ],
                        [
                            'usuario_id' => $usuario->id,
                            'bandeira' => $dados_ultima_compra_cartao_credito['bandeira'],
                            'numero' => $dados_ultima_compra_cartao_credito['numero'],
                            'vencimento' => $dados_ultima_compra_cartao_credito['vencimento'],
                            'valor' => $dados_ultima_compra_cartao_credito['valor']
                        ]
                    );

                }
            }
            DB::commit();

            return ['success' => true, 'message' => 'Sucesso'];
        } catch (\Exception $exception) {
            DB::rollback();

            return ['success' => false, 'message' => $exception->getMessage() . ' na linha: ' . $exception->getLine()];
        }
    }
}
