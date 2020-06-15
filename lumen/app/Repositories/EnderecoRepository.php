<?php

namespace App\Repositories;

use App\Endereco;

class EnderecoRepository
{
    /**
     * @param $item
     * @return mixed
     */
    public function save($item)
    {
        $endereco = Endereco::updateOrCreate([
            'cep' => $item['cep'],
            'logradouro' => $item['logradouro'],
            'bairro' => $item['bairro'],
            'cidade' => $item['cidade'],
            'uf' => $item['uf']
        ]);

        return $endereco;
    }
}
