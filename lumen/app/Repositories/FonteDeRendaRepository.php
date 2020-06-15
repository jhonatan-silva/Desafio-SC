<?php

namespace App\Repositories;

use App\FonteDeRenda;

class FonteDeRendaRepository
{
    /**
     * @param $item
     * @param $usuario_id
     * @return mixed
     */
    public function save($item, $usuario_id)
    {
        $fonte_de_renda = FonteDeRenda::updateOrCreate(
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao']
            ],
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao'],
                'valor' => $item['valor']
            ]);

        return $fonte_de_renda;
    }
}
