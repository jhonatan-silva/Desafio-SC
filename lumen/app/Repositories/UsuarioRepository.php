<?php

namespace App\Repositories;

use App\Usuario;

class UsuarioRepository
{
    /**
     * @param $item
     * @param $endereco_id
     * @return mixed
     */
    public function save($item, $endereco_id)
    {
        $usuario = Usuario::updateOrCreate(
            [
                'cpf' => $item['cpf'],
            ],
            [
                'endereco_id' => $endereco_id,
                'nome' => $item['nome'],
                'cpf' => $item['cpf']
            ]);

        return $usuario;
    }
}
