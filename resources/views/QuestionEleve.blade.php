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
@if (empty($quest)==true)
Il n'y a plus de questions en stock !
@else
					{!! Form::open(['url' => 'exercice/'.$type]) !!} 
				
					
					@foreach( $quest as $field=>$value) 
					     
    					
    					@if ($field=='id' or $field=='question')
    					    {!! Form::label($field, $field.' : ') !!} 
    						{!! Form::label($field,$value)!!}</br>
    					@elseif  ( $field=='adresseImage')
    					    {!! Form::label($field, $field.' : ') !!}
                        	{!!Form::text($field,$value )!!}</br>        
    					@elseif  ($field=='reponse' )                        	
							{!! Form::hidden($field,$value) !!}                        	                 	
    					@else 		
    					@endif 			
					@endforeach 
					{!! Form::hidden('dejaVu', $dejaVu) !!}
					{!! Form::hidden('NbrTentative', $NbrTentative) !!}
					{!!Form::submit('Enregistrer', array('class' => 'btn btn-primary'))!!} 
	
	
					
					{!! Form::close() !!}
@endif 		
	
	
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
