@extends('layouts.app')

@section('content')
<div class="container">
 <a href="{{ url('/newUser') }}">Nouveau</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Gestion  des Utilisateurs
                                 
                </div>

                <div class="card-body">
	{{ $users->links() }}

                    
                    			<table class="table">
				<thead>
					<tr>
						<th>#</th>
						<th>Nom</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($users as $user)
						<tr>
							<td><a href="{{ url('/editUser').'/'.$user->id }}">{!! $user->id !!}</a></td>
							<td class="text-primary"><strong><a href="{{ url('/editUser').'/'.$user->id }}">{!! $user->name !!}</a></strong></td>							
							<td class="text-primary"><strong><a href="{{ url('/editUser').'/'.$user->id }}">{!! $user->email !!}</a></strong></td>
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