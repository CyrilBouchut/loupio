<?php
namespace App\Repositories;

use App\Questions;

class QuestionsRepository  extends AbstractRepository
{
    

    public function __construct(Questions $Questions)
    {
        $this->mainModel = $Questions;
    }

 /*   public function getRecherche($rechercher, $n)
    {
        return $this->mainModel->where('nom', 'like', '%' . trim($rechercher) . '%')->paginate($n);
    }*/




}