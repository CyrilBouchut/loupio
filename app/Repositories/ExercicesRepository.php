<?php
namespace App\Repositories;

use App\Questions;
use App\Reponses;
use Illuminate\Support\Facades\Auth;

class ExercicesRepository  extends AbstractRepository
{
    protected $mainModel;    
    public function __construct(Questions $mainModel,Reponses $modelReponses)
    {
        $this->mainModel = $mainModel;       
        $this->modelReponses = $modelReponses;
        $this->MainTable='questions';
    }
    public function getRandom($dejaVu){
        $Question=$this->mainModel->whereNotIn('id', $dejaVu)->inRandomOrder()->first();
        if ($Question==null){
            $arrQuestion=array();
        } else {
            $arrQuestion=$Question->toArray();
        }
        return ($arrQuestion);
    }
    public function enregistreReponse($request){
      //  var_dump(Auth::user()->id);die;
        $idUser=Auth::user()->id;
        $nomUser=Auth::user()->name;
        
        $arrReponse['idEleve']=$idUser;
        $arrReponse['nomEleve']=$nomUser;
        $arrReponse['idQuestion']=$request->input('id');
        $arrReponse['question']=$request->input('question');
        $arrReponse['reponse']=$request->input('reponse');
        $arrReponse['adresseImage']=$request->input('adresseImage');
        $arrReponse['reponseEleve']=$request->input('HistoriqueReponse');
        return $this->store($arrReponse,'reponse' );

    }
    public function store(Array $inputs=array())
    {
        $item = new $this->modelReponses();
        $arr = $this->modelReponses::DefaultValue;
        foreach($arr as $key=>$value){
            if (substr($key,0,4)=='date' and $value=='today'){
                $arr[$key]=date('d/m/Y');
            }
            if (substr($key,0,4)=='date' and $value=='empty'){
                $arr[$key]='0/01/2000';
            }
        }
        unset($arr['id'] );
        foreach($arr as $key=>$value){
            if (isset($inputs[$key])){
                $arr[$key]=$inputs[$key];
            }
        }
        
        $this->save($item, $arr);
        return $item;
    }
    
}