<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FonteDeRenda extends Model
{
    public $table = 'fontes_de_rendas';

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
