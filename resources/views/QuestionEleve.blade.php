@extends('layouts.app') @section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">
					Question ?
					
					{{ Html::image('/etoile.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoile1')) }}
					
					{{ Html::image('/etoile.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoile2',"style"=>"display: none;")) }}
					{{ Html::image('/etoileVide.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoileVide2')) }}
					{{ Html::image('/etoile.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoile3',"style"=>"display: none;")) }}
					{{ Html::image('/etoileVide.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoileVide3')) }}
					{{ Html::image('/etoile.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoile4',"style"=>"display: none;")) }}
					{{ Html::image('/etoileVide.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoileVide4')) }}
					{{ Html::image('/etoile.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoile5',"style"=>"display: none;")) }}
					{{ Html::image('/etoileVide.png', 'alt text', array('img-responsive' => 'css-class','width'=>"30",'id'=>'etoileVide5')) }}				
					
				</div>

				<div class="card-body">
@if (empty($quest)==true)
	Il n'y a plus de questions en stock !
	{!!Form::text('remarqueTop',$remarqueTop,['id'=>'remarqueTop','readonly'=>'readonly', 'disabled'=>true,'size' => 50] )!!}</br>
@else
	{!! Form::open(['url' => 'exercice/'.$type,'id'=>'frmProduct','autocomplete'=>'off']) !!} 

	
	@foreach( $quest as $field=>$value) 
		@if ($field=='question')
		    {!! Form::label($field, $field.' : ') !!} 
			{!! Form::label($field,$value)!!}
			{!! Form::hidden($field,$value,array('id'=>$field)) !!}    </br>
		@elseif  ($field=='id' )	
			{!! Form::hidden($field,$value,array('id'=>$field)) !!}    </br>
		@elseif  ($field=='reponse' )  			                      
			{!! Form::hidden($field,$value,array('id'=>$field)) !!}                        	                 	
		@else 				
		@endif 			
	@endforeach 
	<img src="{{asset('/uploads/' . $quest['adresseImage'])}}" class="img-responsive">	
	{!! Form::hidden('adresseImage', $quest['adresseImage'],array('id'=>'adresseImage')) !!}</br>
	{!! Form::hidden('dejaVu', $dejaVu,array('id'=>'dejaVu')) !!}
	{!! Form::hidden('nombrePassages', $nombrePassages,array('id'=>'nombrePassages')) !!}
	{!! Form::hidden('reponseOk', '0',array('id'=>'reponseOk')) !!}
	{!! Form::hidden('NbrQuestions', $NbrQuestions,array('id'=>'NbrQuestions')) !!}
	{!! Form::hidden('NbrReponsesJuste', $NbrReponsesJuste,array('id'=>'NbrReponsesJuste')) !!}
	{!! Form::hidden('NbrTentative', $NbrTentative,array('id'=>'NbrTentative')) !!}
	{!! Form::hidden('ReponseJuste', '0',array('id'=>'ReponseJuste')) !!}
	{!! Form::hidden('HistoriqueReponse', '',array('id'=>'HistoriqueReponse')) !!}</br>
	{!!Form::label('reponseCadeau','',['id'=>'reponseCadeau',"style"=>"display: none;"] )!!}
	<img src="{{asset('/flecheDroite.png')}}" class="img-responsive" id='flecheDroite'  width="30" style="display: none;">
	{!!Form::text('reponseEleve','',['id'=>'reponseEleve','onKeyPress'=>"if(event.keyCode == 13) submitAction();" ] )!!}	
	
	<img src="{{asset('/valide.jpg')}}" class="img-responsive" id='imageValide'  width="30" style="display: none;" >
	<img src="{{asset('/invalide.jpg')}}" class="img-responsive" id='imageInvalide'  width="30" style="display: none;"></br>							
	{!!Form::text('remarque',$remarqueTop,['id'=>'remarque','readonly'=>'readonly', 'disabled'=>true,'size' => 50,"style"=>"display: none;"] )!!}</br>
	<input class="btn btn-primary" value="Enregistrer" id="submit_value" >
	<script type="text/javascript">

	    document.getElementById("submit_value").onclick = submitAction;					
        function submitAction()
        {
            console.log('ici');
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
    	
    	    if (document.getElementById("reponseEleve").value.toUpperCase().trim()===document.getElementById("reponse").value.toUpperCase().trim() ){
    			if (document.getElementById('reponseOk').value==='1'){
                    if (document.getElementById("flecheDroite").style.display == 'none'){          
                    	document.getElementById('ReponseJuste').value='1';
                    }  
 					document.getElementById("frmProduct").submit();                	
                	return false;
                }      
	 	        	    
    			document.getElementById('submit_value').className = "btn btn-success";     
    			document.getElementById("imageValide").style.display = 'inline';
            	document.getElementById("imageInvalide").style.display = 'none';
            	document.getElementById('submit_value').value='Suivant >>';            	
            	document.getElementById('reponseOk').value='1';  
            } else {
            	document.getElementById('submit_value').className = "btn btn-primary";    
    			document.getElementById("imageValide").style.display = 'none';
            	document.getElementById("imageInvalide").style.display = 'inline';
            	document.getElementById('submit_value').value='Enregistrer';
            	document.getElementById("remarque").value='Erreur, recommence !';
                if ( parseInt(document.getElementById("NbrTentative").value)>3){   
                                                         
                	document.getElementById("flecheDroite").style.display = 'inline'; 
                	document.getElementById("imageValide").style.display = 'none';
                	document.getElementById("imageInvalide").style.display = 'inline';                	
                	document.getElementById("reponseCadeau").innerHTML=document.getElementById("reponse").value;
                	document.getElementById("reponseCadeau").style.display = 'inline';
                }                	               
            }				
           
            document.getElementById("submit_value").disabled = false;
            if (document.getElementById('submit_value').className != "btn btn-success"){
            	document.getElementById("reponseEleve").select();
            }                                            
        }
		
	 </script>
	{!! Form::close() !!}
@endif 		
	<script type="text/javascript">	
	document.addEventListener('DOMContentLoaded', function() {
			
					@if ($NbrQuestions!=0)
					    @if ($NbrReponsesJuste/$NbrQuestions>=0.25)
                			document.getElementById("etoileVide2").style.display = 'none';
                        	document.getElementById("etoile2").style.display = 'inline';					    
					    @endif
					    @if ($NbrReponsesJuste/$NbrQuestions>=0.5)
                			document.getElementById("etoileVide3").style.display = 'none';
                        	document.getElementById("etoile3").style.display = 'inline';					    
					    @endif
					    @if ($NbrReponsesJuste/$NbrQuestions>=0.75)
                			document.getElementById("etoileVide4").style.display = 'none';
                        	document.getElementById("etoile4").style.display = 'inline';					    
					    @endif
					    @if ($NbrReponsesJuste/$NbrQuestions>=1)
                			document.getElementById("etoileVide5").style.display = 'none';
                        	document.getElementById("etoile5").style.display = 'inline';					    
					    @endif

					    
					@endif
					document.getElementById("reponseEleve").select();
	
	});
	</script>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
