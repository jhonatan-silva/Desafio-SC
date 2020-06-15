<?php

namespace App\Repositories;

use App\UltimaCompraDados;

class UltimaCompraDadosRepository
{
    /**
     * @param $item
     * @param $usuario_id
     * @return mixed
     */
    public function save($item, $usuario_id)
    {
        $ultima_compra_dados = UltimaCompraDados::updateOrCreate(
            [
                'usuario_id' => $usuario_id,
                'bandeira' => $item['bandeira'],
                'numero' => $item['numero'],
            ],
            [
                'usuario_id' => $usuario_id,
                'bandeira' => $item['bandeira'],
                'numero' => $item['numero'],
                'vencimento' => $item['vencimento'],
                'valor' => $item['valor']
            ]
        );

        return $ultima_compra_dados;
    }
}
