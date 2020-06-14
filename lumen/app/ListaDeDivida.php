<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListaDeDivida extends Model
{
    public $table = 'lista_de_dividas';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'usuario_id',
        'descricao',
        'valor'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
        'usuario_id' => 'integer',
        'descricao' => 'string'
    ];
}
