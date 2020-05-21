<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    protected $table = 'venda';
    protected $primaryKey = 'idvenda';

    public $timestamps = false;

    //carregar campos da tabela
    protected $fillable = [
    	'idpessoas',
    	'tipo_comprovante',
    	'serie',
    	'num_comprovante',
    	'data_hora',
    	'taxa',
    	'total_venda',
    	'estado'
    ];

    //trabalhar com dados salvos
    protected $guarded = [];
}
