@extends('layouts.app')

@section('content')
<div class="container">
 <a href="{{ url('/newQuestions') }}">Nouveau</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestion  des Questions
                                  {!! Form::open(['url' => 'questions']) !!}
                 
                    {!! Form::text('rechercher',$rechercher  )!!}
               
        {!! Form::submit('Rechercher', array('class' => 'btn btn-primary')) !!}
    {!! Form::close() !!}
                </div>

                <div class="card-body">
	{{ $questions->links() }}

                    
                    			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Libellé prof</th>
						<th>question</th>
						<th>reponse</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					@foreach ($questions as $question)
						<tr>
							<td>{!! $question->id !!}</td>
							<td class="text-primary"><strong><a href="{{ url('/editQuestions').'/'.$question->id }}">{!! $question->libelleProf!!}</a></strong></td>							 
							<td class="text-primary"><strong><a href="{{ url('/editQuestions').'/'.$question->id }}">{!! $question->question!!}</a></strong></td>
							<td class="text-primary"><strong><a href="{{ url('/editQuestions').'/'.$question->id }}">{!! $question->reponse!!}</a></strong></td>
						</tr>
					@endforeach
	  			</tbody>
	  			
			</table>
		
                </div>
            </div>
        </div>
    </div>
</div>
@endsection