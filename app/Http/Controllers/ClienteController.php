<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pessoa;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\PessoaFormRequest;
use DB;

class ClienteController extends Controller
{
    public function __construct() {

    }

    //responsável pela requisição
    public function index(Request $request) {
       if ($request) {
       	 //realizar uma busca atráves de uma pesquisa de texto
       	 //trim - eliminar espaços antes ou depois da palavra digitada para busca
       	 $query=trim($request->get('searchText'));

         $pessoas = DB::table('pessoa')
                     ->where('nome', 'LIKE', '%'.$query.'%')
                     ->where('tipo_pessoa', '=', 'Cliente')
                     ->orwhere('num_doc', 'LIKE', '%'.$query.'%')
                     ->where('tipo_pessoa', '=', 'Cliente')
                     ->orderBy('idpessoas', 'desc')
                     ->paginate(7);

         return view('venda.cliente.index', ["pessoas" => $pessoas, "searchText" => $query]);
       }
    }

    public function create() {
    	return view("venda.cliente.create");
    }

    public function store(PessoaFormRequest $request) {
    	$pessoa = new Pessoa;
    	$pessoa->tipo_pessoa = 'Cliente';
    	$pessoa->nome = $request->get('nome');
    	$pessoa->tipo_documento = $request->get('tipo_documento');
    	$pessoa->num_doc = $request->get('num_doc');
    	$pessoa->endereco = $request->get('endereco');
    	$pessoa->telefone = $request->get('telefone');
    	$pessoa->email = $request->get('email');
    	$pessoa->save();

    	return Redirect::to('venda/cliente');
    }

    public function show($id) {
    	//mostrar dados na view baseado no id
    	return view("venda.cliente.show", ["pessoa" => Pessoa::findOrFail($id)]);
    }

    public function edit($id) {
    	//editar dados baseado no id
    	return view("venda.cliente.edit", ["pessoa" => Pessoa::findOrFail($id)]);
    }

    public function update(PessoaFormRequest $request, $id) {
    	$pessoa = Pessoa::findOrFail($id);
    	$pessoa->tipo_pessoa = 'Cliente';
    	$pessoa->nome = $request->get('nome');
    	$pessoa->tipo_documento = $request->get('tipo_documento');
    	$pessoa->num_doc = $request->get('num_doc');
    	$pessoa->endereco = $request->get('endereco');
    	$pessoa->telefone = $request->get('telefone');
    	$pessoa->email = $request->get('email');
    	$pessoa->update();

    	return Redirect::to('venda/cliente');
    }

    public function destroy($id) {
    	$pessoa = Pessoa::findOrFail($id);
    	$pessoa->tipo_pessoa = 'Inativo';
    	$pessoa->update();

    	return Redirect::to('venda/cliente');
    }
}