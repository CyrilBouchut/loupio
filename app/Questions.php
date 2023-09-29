<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{

    const DefaultValue = array(
        'id' => 0,
        'libelleProf'=>'',
        'question'=>'',    
        'reponse'=>'',
        'adresseImage'=>'',
    );

    protected $table = 'questions';

}
