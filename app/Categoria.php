<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    protected $table = 'categoria';
    protected $primaryKey = 'idcategoria';

    public $timestamps = false;

    //carregar campos da tabela
    protected $fillable = [
    	'nome',
    	'descricao',
    	'condicao'
    ];

    //trabalhar com dados salvos
    protected $guarded = [];
}
