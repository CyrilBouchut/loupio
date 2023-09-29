<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Collective\Html\Eloquent\FormAccessible;
use App\Repositories\ExercicesRepository;
use App\Questions;
use App\Http\Requests;

class ExerciceController extends Controller
{

    
    public function __construct(ExercicesRepository $ExercicesRepository)
    {
       
        $this->mainRepository = $ExercicesRepository;        
        $this->middleware('auth');
        
    }

    public function index($recherche='')
    {               
        return parent::index('');
    }
  
    public function getExercice($type='',$id, $RechercheTiers = '')
    {
        $arrDejaVu=array();
        $question = $this->mainRepository->getRandom($arrDejaVu=array());    
        $NbrTentative=1;
        $arrDejaVu[]=$question['id'];
        return view('QuestionEleve', array('quest'=>$question,'dejaVu'=>json_encode($arrDejaVu),'NbrTentative'=>$NbrTentative,'type'=>$type,'remarqueTop'=>''));
        
    }
    public function postExercice($type='', Request $request)
    {
        $remarqueTop='';
        if ($request->input('reponseEleve')==$request->input('reponse')){
            $remarqueTop='Dernière réponse correcte';
        } else {
            $remarqueTop='Dernière réponse fausse. Bonne réponse : '.$request->input('reponse');
        }
             
        $arrDejaVu =json_decode( $request->input('dejaVu'));       
        $question = $this->mainRepository->getRandom($arrDejaVu);
        $NbrTentative=1;
        if ($question!=null){            
            $arrDejaVu[]=$question['id'];
        }
                  
        return view('QuestionEleve', array('quest'=>$question,'dejaVu'=>json_encode($arrDejaVu),'NbrTentative'=>$NbrTentative,'type'=>$type,'remarqueTop'=>$remarqueTop));
        
    }
    
}
