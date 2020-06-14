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

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'cep' => 'string',
        'logradouro' => 'string',
        'bairro' => 'string',
        'cidade' => 'string',
        'uf' => 'string'
    ];
}
