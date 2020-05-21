@extends('layouts.admin')
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Vendas <a href="venda/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('venda.venda.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover text-center">
				<thead>
					<th>Id</th>
					<th>Nome Cliente</th>
					<th>Tipo Comprovante</th>
					<th>Série</th>
					<th>Número Comprovante</th>
					<th>Taxa</th>
					<th>Total Venda</th>
					<th>Data</th>
					<th>Estado</th>
					<th>Opções</th>
				</thead>
               @foreach ($vendas as $v)
				<tr>
					<td>{{ $v->idvenda}}</td>
					<td>{{ $v->pessoa}}</td>
					<td>{{ $v->tipo_comprovante}}</td>
					<td>{{ $v->serie}}</td>
                    <td>{{ $v->num_comprovante}}</td> 
                    <td>{{ $v->taxa}}</td>
                    <td>{{ $v->total_venda}}</td>   
                    <td>{{ $v->data_hora}}</td>                 
                    <td>{{ $v->estado}}</td>
					<td>
						<a href="{{URL::action('VendaController@edit',$v->idvenda)}}"><button class="btn btn-info">Editar</button></a>
                        <a href="" data-target="#modal-delete-{{$v->idvenda}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('venda.venda.modal')
				@endforeach
			</table>
		</div>
		{{$vendas->render()}}
	</div>
</div>

@stop