<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MovimentacaoFinanceira extends Model
{
    public $table = 'movimentacoes_financeiras';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'usuario_id',
        'descricao',
        'valor'
    ];

}
