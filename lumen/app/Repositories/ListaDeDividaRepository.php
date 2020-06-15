<?php

namespace App\Repositories;

use App\ListaDeDivida;

class ListaDeDividaRepository
{
    /**
     * @param $item
     * @param $usuario_id
     * @return mixed
     */
    public function save($item, $usuario_id)
    {
        $lista_de_divida = ListaDeDivida::updateOrCreate(
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao']
            ],
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao'],
                'valor' => $item['valor']
            ]);

        return $lista_de_divida;
    }
}
