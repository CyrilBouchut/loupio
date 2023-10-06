<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Collective\Html\Eloquent\FormAccessible;
use App\Http\Requests;
use App\Http\Requests\QuestionsRequest;
use App\Repositories\QuestionsRepository;
use App\Questions;
use Illuminate\Support\Facades\Auth;

class QuestionsController extends Controller
{

    
    protected $nbrPerPage = 4;
    public function __construct(QuestionsRepository $QuestionsRepository,Questions $Questions)
    {              
        $this->MainTable='questions';
        $this->MainItem='questions';
        $this->MainModel=$Questions;       
        $this->mainRepository = $QuestionsRepository;
        $this->middleware('auth');       
    }
    public function new(){
        return parent::new();
    }
    
    public function index($rechercher = '')
    {
        
        return $this->indexAbstract('questions',true,Null,$rechercher);
    }

    public function postIndex($rechercher = '', Request $request)
    {
        
        return $this->indexAbstract('questions',true,$request,$rechercher);
    }


    public function postEdit($id,QuestionsRequest $request)
    {   
        
        if ($request->file!=null){
            $fileName = time().'.'.$request->file->extension();
             $request->file->move(public_path('uploads'), $fileName);
            $request->merge(['adresseImage'=> $fileName]);
        }
        return $this->postAbstract($this->MainItem,$id,$request);
    }
/*    public function postSelect2(Request $request)
    {
        $search = $request->search;
        
        if ($search == '') {
            $tiers = Tiers::orderby('nom', 'asc')->select('id', 'nom')
            ->limit(5)
            ->get();
        } else {
            $tiers = Tiers::orderby('nom', 'asc')->select('id', 'nom')
            ->where('nom', 'like', '%' . $search . '%')
            ->limit(5)
            ->get();
        }
        
        $response = array();
        foreach ($tiers as $tier) {
            $response[] = array(
                "id" => $tier->id,
                "text" => $tier->nom
            );
        }
        
        echo json_encode($response);
        exit();
    }*/

}
