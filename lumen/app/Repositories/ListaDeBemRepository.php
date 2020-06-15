<?php

namespace App\Repositories;

use App\ListaDeBem;

class ListaDeBemRepository
{
    /**
     * @param $item
     * @param $usuario_id
     * @return mixed
     */
    public function save($item, $usuario_id)
    {
        $lista_de_bem = ListaDeBem::updateOrCreate(
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao']
            ],
            [
                'usuario_id' => $usuario_id,
                'descricao' => $item['descricao'],
                'valor' => $item['valor']
            ]);

        return $lista_de_bem;
    }
}
