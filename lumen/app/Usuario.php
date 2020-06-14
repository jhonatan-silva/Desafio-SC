<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $table = 'usuarios';

    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'updated_at';


    public $fillable = [
        'endereco_id',
        'nome',
        'idade',
        'cpf',
        'ultima_consulta_cpf'
    ];

}
