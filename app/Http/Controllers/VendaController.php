<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Venda;
use Illuminate\Support\Facades\Redirect; 
use App\Http\Requests\VendaFormRequest;
use DB;

class VendaController extends Controller
{
    public function __construct() {

    }

    //responsável pela requisição
    public function index(Request $request) {
       if ($request) {
       	 //realizar uma busca atráves de uma pesquisa de texto
       	 //trim - eliminar espaços antes ou depois da palavra digitada para busca
       	 $query=trim($request->get('searchText'));

         $vendas = DB::table('venda as v')
                ->join('pessoa as pes', 'v.idpessoas', '=', 'pes.idpessoas')
                ->select('v.idvenda', 'v.tipo_comprovante', 'v.serie', 'v.num_comprovante', 'v.taxa', 'v.total_venda', 'v.data_hora', 'v.estado', 'pes.nome as pessoa')
                ->where('v.tipo_comprovante', 'LIKE', '%'.$query.'%')
                ->orwhere('pes.nome', 'LIKE', '%'.$query.'%')
                ->where('estado', '=', 'Ativa')
                ->orderBy('idvenda', 'desc')
                ->paginate(7);

         return view('venda.venda.index', ["vendas" => $vendas, "searchText" => $query]);
       }
    }

    public function create() {
        $pessoas = DB::table('pessoa')
                    ->where('tipo_pessoa', '=', 'Cliente')
                    ->get(); //executar a ação

    	return view("venda.venda.create", ["pessoas" => $pessoas]);
    }

    public function store(VendaFormRequest $request) {
    	$venda = new Venda;
    	$venda->idpessoas = $request->get('idpessoas');
    	$venda->tipo_comprovante = $request->get('tipo_comprovante');
    	$venda->serie = $request->get('serie');
        $venda->num_comprovante = $request->get('num_comprovante');
        $venda->taxa = $request->get('taxa'); 
        $venda->total_venda = $request->get('total_venda');  
        $venda->estado = 'Ativa';

    	$venda->save();

    	return Redirect::to('venda/venda');
    }

    public function show($id) {
    	//mostrar dados na view baseado no id
    	return view("venda.venda.show", ["venda" => Venda::findOrFail($id)]);
    }

    public function edit($id) {
    	//editar dados baseado no id
        $venda = Venda::findOrFail($id);
        $pessoas = DB::table('pessoa')->where('tipo_pessoa', '=', 'Cliente')->get();

    	return view("venda.venda.edit", ["venda" => $venda, "pessoas" => $pessoas]);
    }

    public function update(VendaFormRequest $request, $id) {
    	$venda = Venda::findOrFail($id);
    	$venda->idpessoas = $request->get('idpessoas');
    	$venda->tipo_comprovante = $request->get('tipo_comprovante');
    	$venda->serie = $request->get('serie');
        $venda->num_comprovante = $request->get('num_comprovante');
        $venda->taxa = $request->get('taxa'); 
        $venda->total_venda = $request->get('total_venda');  
        //$venda->estado = 'Ativa';

    	$venda->update();

    	return Redirect::to('venda/venda');
    }

    public function destroy($id) {
    	$venda = Venda::findOrFail($id);
    	$venda->estado = 'Inativa';
    	$venda->update();

    	return Redirect::to('venda/venda');
    }
}