@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Edition des tiers <a href="{{ url('/tiers') }}">retour liste des
						tiers</a>
				</div>

				<div class="card-body">

					{!! Form::open(['url' => 'postQuestion/'.$quest['id']]) !!} 
				
					
					@foreach( $quest as $field=>$value) 
					     
    					
    					@if ($field=='id' or $field=='question')
    					    {!! Form::label($field, $field.' : ') !!} 
    						{!! Form::label($field,$value)!!}</br>
    					@elseif  ($field=='reponse' or $field=='adresseImage')
    					    {!! Form::label($field, $field.' : ') !!}
                        	{!!Form::text($field,$value )!!}</br>                         	
    					@else 		
    					@endif 			
					@endforeach 
					{!!Form::submit('Enregistrer', array('class' => 'btn btn-primary'))!!} {!! Form::close() !!}

	
	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
