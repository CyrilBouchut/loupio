<?php
namespace App\Repositories;

use App\User;

class UsersRepository  extends AbstractRepository
{

    protected $mainModel;
    
    public function __construct(User $mainModel)
    {
        $this->mainModel = $mainModel;
        $this->MainTable='users';
    }
}