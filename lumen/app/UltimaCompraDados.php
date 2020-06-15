<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UltimaCompraDados extends Model
{
    public $table = 'ultima_compra_dados';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'usuario_id',
        'bandeira',
        'numero',
        'vencimento',
        'valor'
    ];

    public function getValorAttribute($value)
    {
        return 'R$ ' . number_format(round($value, 2), 2, ',', '.');
    }

}
