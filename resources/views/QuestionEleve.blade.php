@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Question ?
				</div>

				<div class="card-body">
@if (empty($quest)==true)
	Il n'y a plus de questions en stock !
	{!!Form::text('remarqueTop',$remarqueTop,['id'=>'remarqueTop','readonly'=>'readonly', 'disabled'=>true,'size' => 50] )!!}</br>
@else
	{!! Form::open(['url' => 'exercice/'.$type,'id'=>'frmProduct']) !!} 

	{!!Form::text('remarqueTop',$remarqueTop,['id'=>'remarqueTop','readonly'=>'readonly', 'disabled'=>true,'size' => 50] )!!}</br>
	@foreach( $quest as $field=>$value) 
	     
		
		@if ($field=='id' or $field=='question')
		    {!! Form::label($field, $field.' : ') !!} 
			{!! Form::label($field,$value)!!}</br>
		@elseif  ($field=='reponse' )                        	
			{!! Form::hidden($field,$value,array('id'=>$field)) !!}                        	                 	
		@else 		
		
		@endif 			
	@endforeach 
	<img src="{{asset('/uploads/' . $quest['adresseImage'])}}" class="img-responsive"></br>
	{!! Form::hidden('dejaVu', $dejaVu,array('id'=>'dejaVu')) !!}
	{!! Form::hidden('NbrTentative', $NbrTentative,array('id'=>'NbrTentative')) !!}
	{!! Form::hidden('HistoriqueReponse', '',array('id'=>'HistoriqueReponse')) !!}</br>
	<input name="reponseEleve" type="text" value="" id="reponseEleve"></br>					
	<input name="remarque" id="remarque" readonly="readonly" disabled value="" ></br>
	<input class="btn btn-primary" value="Enregistrer" id="submit_value" >
	<script type="text/javascript">
	    document.getElementById("submit_value").onclick = submitAction;					
        function submitAction()
        {
        		document.getElementById("submit_value").disabled = true;
        		document.getElementById("NbrTentative").value=parseInt(document.getElementById("NbrTentative").value)+1;
        		var json =document.getElementById("HistoriqueReponse").value
        		if (json===''){
        			var obj =[];
        		}else{
        			var obj = JSON.parse(json);
        		}	                        	
        		obj.push(document.getElementById("reponseEleve").value);
        		document.getElementById("HistoriqueReponse").value=JSON.stringify(obj);
        	if (document.getElementById("reponseEleve").value.toUpperCase()===document.getElementById("reponse").value.toUpperCase() || parseInt(document.getElementById("NbrTentative").value)>5){                          
                document.getElementById("frmProduct").submit();
                return false;
            } else {
            	document.getElementById("remarque").value='Erreur, recommence !';                            	
            }    
            document.getElementById("submit_value").disabled = false;                                
        }
		
	 </script>
	{!! Form::close() !!}
@endif 		
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
