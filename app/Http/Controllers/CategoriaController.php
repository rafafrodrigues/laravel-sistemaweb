<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use SistemaWeb\Categoria;
use Illuminate\Support\Facades\Redirect;
use SistemaWeb\Http\Requests\CategoriaFormRequest;
use DB;

class CategoriaController extends Controller
{
    public function __construct() {

    }

    //responsável pela requisição
    public function index(Request $request) {
       if ($request) {
       	 //realizar uma busca atráves de uma pesquisa de texto
       	 //trim - eliminar espaços antes ou depois da palavra digitada para busca
       	 $query=trim($request->get('searchText'));

         $categorias = DB::table('categoria')->where('nome', 'LIKE', '%'.$query.'%')->where('condicao', '=', '1')->orderBy('idcategoria', 'desc')->paginate(7);

         return view('estoque.categoria.index', [
         	"categorias" => $categorias, "searchText" => $query
         ]);
       }
    }

    public function create() {
    	return view("estoque.categoria.create");
    }

    public function store(CategoriaFormRequest $request) {
    	$categoria = new Categoria;
    	$categoria->nome = $request->get('nome');
    	$categoria->descricao = $request->get('descricao');
    	$categoria->condicao = 1;
    	$categoria->save();

    	return Redirect::to('estoque/categoria');
    }

    public function show($id) {
    	//mostrar dados na view baseado no id
    	return view("estoque.categoria.show", ["categoria" => Categoria::findOrFail($id)]);
    }

    public function edit($id) {
    	//editar dados baseado no id
    	return view("estoque.categoria.edit", ["categoria" => Categoria::findOrFail($id)]);
    }

    public function update(CategoriaFormRequest $request, $id) {
    	$categoria = Categoria::findOrFail($id);
    	$categoria->nome = $request->get('nome');
    	$categoria->descricao = $request->get('descricao');
    	$categoria->update();

    	return Redirect::to('estoque/categoria');
    }

    public function destroy($id) {
    	$categoria = Categoria::findOrFail($id);
    	$categoria->condicao = '0';
    	$categoria->update();

    	return Redirect::to('estoque/categoria');
    }
}
