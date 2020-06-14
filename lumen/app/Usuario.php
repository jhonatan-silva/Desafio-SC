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

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     **/
    public function endereco()
    {
        return $this->belongsTo(Endereco::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function listaDeDividas()
    {
        return $this->hasMany(ListaDeDivida::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function listaDeBens()
    {
        return $this->hasMany(ListaDeBem::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function fontesDeRendas()
    {
        return $this->hasMany(FonteDeRenda::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     **/
    public function movimentacoesFinanceiras()
    {
        return $this->hasMany(MovimentacaoFinanceira::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     **/
    public function dadoUltimaCompraCartaoCredito()
    {
        return $this->hasOne(DadosUltimaCompraCartaoCredito::class);
    }

    public function getUltimaConsultaCpfAttribute($value)
    {
        return $value ? with(new\Carbon\Carbon($value))->format('d/m/Y H:i') : '';
    }
}
