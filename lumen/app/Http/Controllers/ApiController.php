<?php

namespace App\Http\Controllers;

use App\Repositories\ApiRepository;
use App\Repositories\UltimaCompraDadosRepository;
use App\Repositories\EnderecoRepository;
use App\Repositories\FonteDeRendaRepository;
use App\Repositories\ListaDeBemRepository;
use App\Repositories\ListaDeDividaRepository;
use App\Repositories\MovimentacaoFinanceiraRepository;
use App\Repositories\UsuarioRepository;
use App\Usuario;
use Illuminate\Support\Facades\DB;

class ApiController extends Controller
{
    protected $apiRepository;
    protected $enderecoRepository;
    protected $usuarioRepository;
    protected $listaDeDividaRepository;
    protected $listaDeBemRepository;
    protected $fonteDeRendaRepository;
    protected $movimentacaoFinanceiraRepository;
    protected $ultimaCompraDadosRepository;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(
        ApiRepository $apiRepository,
        EnderecoRepository $enderecoRepository,
        UsuarioRepository $usuarioRepository,
        ListaDeDividaRepository $listaDeDividaRepository,
        ListaDeBemRepository $listaDeBemRepository,
        FonteDeRendaRepository $fonteDeRendaRepository,
        MovimentacaoFinanceiraRepository $movimentacaoFinanceiraRepository,
        UltimaCompraDadosRepository $ultimaCompraDadosRepository
    ) {
        $this->apiRepository = $apiRepository;
        $this->enderecoRepository = $enderecoRepository;
        $this->usuarioRepository = $usuarioRepository;
        $this->listaDeDividaRepository = $listaDeDividaRepository;
        $this->listaDeBemRepository = $listaDeBemRepository;
        $this->fonteDeRendaRepository = $fonteDeRendaRepository;
        $this->movimentacaoFinanceiraRepository = $movimentacaoFinanceiraRepository;
        $this->ultimaCompraDadosRepository = $ultimaCompraDadosRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * @return array
     */
    public function syncBaseA()
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/a.json';
            $headers = [
                'Content-Type' => 'application/json',
                // 'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
            ];

            $base_a = $this->apiRepository->connect($uri, $headers);

            foreach ($base_a as $item) {
                $endereco = $this->enderecoRepository->save($item['endereco']);

                $usuario = $this->usuarioRepository->save($item, $endereco->id);

                foreach ($item['lista_de_dividas'] as $lista_de_divida) {
                    $this->listaDeDividaRepository->save($lista_de_divida, $usuario->id);
                }
            }

            DB::commit();

            return ['success' => true, 'message' => 'Sucesso'];
        } catch (\Exception $exception) {
            DB::rollback();

            return ['success' => false, 'message' => $exception->getMessage() . ' na linha: ' . $exception->getLine()];
        }
    }

    /**
     * @param $usuarios
     * @return array
     */
    public function syncBaseB($usuarios)
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/b.json';
            $headers = [
                'Content-Type' => 'application/json',
                // 'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
            ];

            $base_b = $this->apiRepository->connect($uri, $headers);

            foreach ($usuarios as $usuario) {
                if (isset($base_b[$usuario->cpf])) {
                    $item = $base_b[$usuario->cpf];

                    $usuario->update(['idade' => $item['idade']]);

                    foreach ($item['lista_de_bens'] as $lista_de_bem) {
                        $this->listaDeBemRepository->save($lista_de_bem, $usuario->id);
                    }

                    foreach ($item['fontes_de_rendas'] as $fonte_de_renda) {
                        $this->listaDeBemRepository->save($fonte_de_renda, $usuario->id);

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

    /**
     * @param $usuarios
     * @return array
     */
    public function syncBaseC($usuarios)
    {
        DB::beginTransaction();
        try {
            $uri = 'https://raw.githubusercontent.com/jhonatan-silva/desafio_sc/master/api_bases/c.json';
            $headers = [
                'Content-Type' => 'application/json',
                // 'Authorization' => 'Bearer 1a59asb34dhta923b347g7f2g3b543g632765j41'
            ];

            $base_c = $this->apiRepository->connect($uri, $headers);

            foreach ($usuarios as $usuario) {
                if (isset($base_c[$usuario->cpf])) {
                    $item = $base_c[$usuario->cpf];

                    $usuario->update(['ultima_consulta_cpf' => $item['ultima_consulta_cpf']]);

                    foreach ($item['movimentacoes_financeiras'] as $movimentacao_financeira) {
                        $this->movimentacaoFinanceiraRepository->save($movimentacao_financeira, $usuario->id);
                    }

                    $this->ultimaCompraDadosRepository->save($item['dados_ultima_compra_cartao_credito'], $usuario->id);
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
