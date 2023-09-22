@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Edition des tiers <a href="{{ url('/users') }}">retour liste des
						Utilisateurs</a>
				</div>

				<div class="card-body">

					{!! Form::open(['url' => 'editUser/'.$id]) !!} 
					@foreach( $fields as $field=>$defaultValue)     					
    					@if ($field=='id') 
    					{!! Form::label($field, $field.' : ') !!}
    					{!! Form::text($field,$$field,array('readonly'=>true) )!!}</br>
    					@elseif ($field=='password')
    					@else
    					{!! Form::label($field, $field.' : ') !!}
                        {!!Form::text($field,$$field )!!}</br> 
    					@endif 
    					{!! $errors->first($field, '<small class="help-block">:message</small></br>') !!}
					@endforeach 
					{!!Form::submit('Enregistrer', array('class' => 'btn btn-primary'))!!} {!! Form::close() !!}


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
