<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pessoa extends Model
{
    protected $table = 'pessoa';
    protected $primaryKey = 'idpessoas';

    public $timestamps = false;

    //carregar campos da tabela
    protected $fillable = [
    	'tipo_pessoa',
    	'nome',
    	'tipo_documento',
    	'num_doc',
    	'endereco',
    	'telefone',
    	'email'
    ];

    //trabalhar com dados salvos
    protected $guarded = [];
}
