<?php

namespace App\Repositories;

use App\MovimentacaoFinanceira;

class MovimentacaoFinanceiraRepository
{
    /**
     * @param $item
     * @param $usuario_id
     * @return mixed
     */
    public function save($item, $usuario_id)
    {
        $movimentacao_financeira = MovimentacaoFinanceira::updateOrCreate(
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao']
            ],
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao'],
                'valor' => $item['valor']
            ]);

        return $movimentacao_financeira;
    }
}
