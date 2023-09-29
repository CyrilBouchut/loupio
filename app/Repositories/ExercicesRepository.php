<?php
namespace App\Repositories;

use App\Questions;

class ExercicesRepository  extends AbstractRepository
{
    protected $mainModel;    
    public function __construct(Questions $mainModel)
    {
        $this->mainModel = $mainModel;
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
    
}