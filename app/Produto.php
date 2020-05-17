<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produto';
    protected $primaryKey = 'idproduto';

    public $timestamps = false;

    //carregar campos da tabela
    protected $fillable = [
    	'idcategoria',
    	'codigo',
    	'nome',
    	'estoque',
    	'descricao',
    	'imagem',
    	'estado'
    ];

    //trabalhar com dados salvos
    protected $guarded = [];
}
