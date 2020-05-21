@extends('layouts.admin')
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Venda: {{ $venda->idpessoas }}</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif
		</div>
</div>			

	{!!Form::model($venda, ['method'=>'PATCH', 'route' => ['venda.update', $venda->idvenda], 'files' => 'true'])!!}
	{{Form::token()}}
    <div class="row">        
        <div class="col-lg-6 col-sm-6 col-xs-12">
        	<div class="form-group">
        		<label>Nome Cliente</label>
        		<select name="idpessoas" class="form-control">
        			@foreach($pessoas as $pes)
	        			@if($pes->idpessoas==$venda->idpessoas)
	        			  <option value="{{$pes->idpessoas}}" selected="">{{$pes->nome}}</option>
	        			@else
                          <option value="{{$pes->idpessoas}}">{{$pes->nome}}</option>
                        @endif  
        			@endforeach
        		</select>
        	</div>
        </div>

        <div class="col-lg-6 col-sm-6 col-xs-12">
            	<div class="form-group">
		           	<label for="tipo_comprovante">Tipo Comprovante</label>
		           	<input type="text" name="tipo_comprovante" required="" class="form-control" placeholder="Tipo de Comprovante..." value="{{$venda->tipo_comprovante}}">
		      </div>
            </div>
  
            <div class="col-lg-6 col-sm-6 col-xs-12">
            	<div class="form-group">
		           	<label for="serie">Série</label>
		           	<input type="text" name="serie" class="form-control" required="" placeholder="Digite a Série..." value="{{$venda->serie}}">
		      </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-xs-12">
            	<div class="form-group">
		           	<label for="num_comprovante">Número Comprovante</label>
		           	<input type="text" name="num_comprovante" class="form-control" required="" placeholder="Número do Comprovante..." value="{{$venda->num_comprovante}}">
		      </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-xs-12">
            	<div class="form-group">
		           	<label for="taxa">Taxa</label>
		           	<input type="text" name="taxa" class="form-control" required="" placeholder="Digite a Taxa..." value="{{$venda->taxa}}">
		      </div>
            </div>

            <div class="col-lg-6 col-sm-6 col-xs-12">
            	<div class="form-group">
		           	<label for="total_venda">Total Venda</label>
		           	<input type="text" name="total_venda" class="form-control" required="" value="{{$venda->total_venda}}" placeholder="Digite o Total da Venda" >
		      </div>
            </div>    	
              
        <div class="form-group">
          	<button class="btn btn-primary" type="submit">Salvar</button>
           	<button class="btn btn-danger" type="reset">Cancelar</button>
        </div>
    </div>    
	{!!Form::close()!!}		

@stop