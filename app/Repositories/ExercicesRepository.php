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
        $Question=$this->mainModel->inRandomOrder()->first();
        return ($Question->toArray());
    }
    
}