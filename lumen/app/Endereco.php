<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    public $table = 'enderecos';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'cep',
        'logradouro',
        'bairro',
        'cidade',
        'uf'
    ];

}
