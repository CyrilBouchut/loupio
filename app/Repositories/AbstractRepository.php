<?php

namespace App\Repositories;



class AbstractRepository 
{
    public function getPaginate($n,$key='')
    {        
        $mainModel=$this->mainModel;
        if ($key=='' and isset($this->order)) $key=$this->order;
        if ($key==''){             
            return $mainModel->paginate($n);
        } else {
            return $mainModel->orderBy($key,'asc')->paginate($n);
        }
    }

    public function store(Array $inputs=array())
    {   
        $item = new $this->mainModel();
        $arr = $this->mainModel::DefaultValue;
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
 	protected function save($model, Array $inputs)
	{	    
	    foreach ($model::DefaultValue as $key => $value) {
	        if (isset($inputs[$key])) {
	            $model->{$key} = $inputs[$key];
	        } elseif ($model->{$key}==null) {
	            $model->{$key} = $value;
	        }
	    }	    
	    if ($model->compteComptableTva_id==null and isset($inputs['compteComptableTva_id'])) return back()->with('error','Erreur configuration TVA');
	    $model->save();
	}
	public function getById($id)
	{
	    return $this->mainModel->findOrFail($id);
	}
	public function getAll(){	    
	    return $this->mainModel->all();
	}
	public function update($id, Array $inputs)
	{
	    $item = $this->getById($id);
	    $this->save($item, $inputs);
	    return $item;
	}
	public function getLigne($id)
	{
	    return $this->ModelLigne->where($this->MainItem.'_id', '=', $id)->orderBy('nligne')->get();
	}
	public function updateLigne($id, Array $inputs)
	{
	    $Ligne=$this->getByIdLigne($id);
	    $this->saveLigne($Ligne, $inputs);
	    return $Ligne;
	}
	public function getByIdLigne($id)
	{
	    return $this->ModelLigne->findOrFail($id);
	}
	public function delete($id)
	{
	    $this->mainModel->where('id', '=', $id)->delete();
	}
	static function dateYmd($date){	   
	    $date=substr($date,6,4).'-'.substr($date,3,2).'-'.substr($date,0,2);	  
	    return $date;
	}
	//2021-11-10 -> 10/11/2021
	static function datedmY($date){
	    if(substr($date,2,1)=='/' and substr($date,5,1)=='/' ){
	        $date=$date;
	    } else {
	       $date=substr($date,8,2).'/'.substr($date,5,2).'/'.substr($date,0,4);
	    }
	    return $date;
	}

}