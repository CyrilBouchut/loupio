<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Collective\Html\Eloquent\FormAccessible;
//use App\Http\Requests;
use App\Repositories\UsersRepository;

use App\User;


class UsersController extends Controller
{

    protected $entrepriseUsers;
    protected $nbrPerPage = 4;
    public function __construct(UsersRepository $usersRepository,User $user)
    {
        
        
        $this->MainTable='users';
        $this->MainItem='user';
        $this->MainModel=$user;  
        $this->mainRepository = $usersRepository;        
        
        
        //$this->entrepriseRepository = $entrepriseRepository;
        //$this->arrToAddToView = array('arrEntreprise'=>$this->entrepriseRepository->getAllToSelect());
        $this->middleware('auth');
    }

    public function postEdit($id,Request $request){
        return $this->postAbstract($this->MainTable,$id,$request);
    }


}
