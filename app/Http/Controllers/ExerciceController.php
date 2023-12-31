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
        return view('QuestionEleve', array('quest'=>$question,'dejaVu'=>json_encode($arrDejaVu),'NbrTentative'=>$NbrTentative,'type'=>$type,'remarqueTop'=>'','nombrePassages'=>1,'NbrQuestions'=>0,'NbrReponsesJuste'=>0));
        
    }
    public function postExercice($type='', Request $request)
    {
        $remarqueTop='';
        $nombrePassages=$request->input('nombrePassages');  
        $NbrQuestions=$request->input('NbrQuestions');
        $NbrReponsesJuste=$request->input('NbrReponsesJuste')+$request->input('ReponseJuste');       
        if (strtoupper(trim($request->input('reponseEleve')))==strtoupper(trim($request->input('reponse')))){
            $remarqueTop='Dernière réponse correcte';
        } else {
            $remarqueTop='Dernière réponse fausse. Bonne réponse : '.$request->input('reponse');
        }
             
        $arrDejaVu =json_decode( $request->input('dejaVu'));  
        $this->mainRepository->enregistreReponse($request);
        $question = $this->mainRepository->getRandom($arrDejaVu);
        if ($question!=null){
            $arrDejaVu[]=$question['id'];

        } else {
            if ($nombrePassages<2){
                $arrDejaVu=array();
                $question = $this->mainRepository->getRandom($arrDejaVu);
            }
            $nombrePassages=$nombrePassages+1;
        }
        if ($question!=null){
            $NbrQuestions=$NbrQuestions+1;
        }
        $NbrTentative=1;
        return view('QuestionEleve', array('quest'=>$question,'dejaVu'=>json_encode($arrDejaVu),'NbrTentative'=>$NbrTentative,'type'=>$type,'remarqueTop'=>$remarqueTop,'nombrePassages'=>$nombrePassages,'NbrQuestions'=>$NbrQuestions,'NbrReponsesJuste'=>$NbrReponsesJuste));
        
    }
    
}
