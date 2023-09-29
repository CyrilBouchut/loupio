@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Edition des Questions <a href="{{ url('/listeQuestions') }}">retour liste des
						questions</a>
				</div>

				<div class="card-body">

					{!! Form::open(['url' => 'editQuestion/'.$id,'enctype'=>'multipart/form-data']) !!} 
					{!!Form::submit('Enregistrer', array('class' => 'btn btn-primary','name'=>'action'))!!}					
					</br></br>
					<img src="{{asset('/uploads/' . $fields['adresseImage'])}}" class="img-responsive"></br>
					@foreach( $fields as $field=>$defaultValue) 
					{!! Form::label($field, $field.' : ') !!}
					@if ($field=='id') 
					{!! Form::label($field,$$field )!!}</br>
					@else
                    {!!Form::text($field,$$field )!!}</br> 
					@endif 
					{!! $errors->first($field, '<small class="help-block">:message</small></br>') !!}
					@endforeach 
					<input type="file" name="file" class="form-control">
					{!!Form::submit('Enregistrer', array('class' => 'btn btn-primary'))!!} {!! Form::close() !!}


				</div>
			</div>
		</div>
	</div>
</div>
@endsection
