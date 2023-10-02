<?php
namespace App;

use Illuminate\Database\Eloquent\Model;

class Reponses extends Model
{
    const DefaultValue = array(
        'id' => 0,
        'idEleve'=>'',
        'idQuestion'=>'',
        'nomEleve'=>'',
        'question'=>'',
        'reponse'=>'',
        'adresseImage'=>'',
        'reponseEleve'=>'',
    );

    protected $table = 'reponses';

}
