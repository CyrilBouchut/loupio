<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index($rechercher = '')
    {
        
        return $this->indexAbstract($this->MainTable);
        
    }
    public function getEdit($id, $RechercheTiers = '')
    {
      //  var_dump('getEdit');die;
        
        
        return $this->getAbstract($id);
    }
    protected function getAbstract($id)
    {        
        $item =  $this->mainRepository->getById($id);
       
        $arr = $this->getValues($item);
        $arr['fields'] = $arr;
        if (isset($this->arrToAddToView)){
            $arr=array_merge($arr,$this->arrToAddToView);
        }
        if (isset($this->arrToAddToView)){
            $arr=array_merge($arr,$this->arrToAddToView);
        }
       
        return view('edit' . ucfirst($this->MainItem), $arr);
    }
    protected  function getValues($item)
    {
        $arr = array();
        foreach ($this->MainModel::DefaultValue as $key => $value) {
            $arr[$key] = $item->{$key};
        }
        return $arr;
    }
    protected function indexAbstract($NomTable, $WithRecherche = false, $request = null, $rechercher = '')
    {
        
        if ($WithRecherche ) {
            if ($request!=null and $request->input('rechercher') != NULL) {
                return redirect($NomTable . '/' . urlencode($request->input('rechercher')));
            }
            if ($rechercher === NULL)
                $rechercher = '';
                
                if ($rechercher != '') {
                    $$NomTable = $this->mainRepository->getRecherche($rechercher, $this->nbrPerPage);
                } else {
                    $$NomTable = $this->mainRepository->getPaginate($this->nbrPerPage);
                }
        } else {
            $$NomTable = $this->mainRepository->getPaginate($this->nbrPerPage);
        }
        $links = $$NomTable->render();
        $arr=[
            $NomTable => $$NomTable,
            'links' => $links,
            'rechercher' => ''
        ];
        if (isset($this->arrToAddToView)){
            $arr=array_merge($arr,$this->arrToAddToView);
        }
        return view($NomTable,$arr );
    }
    
    protected function postAbstract($NomTable, $id, $request)
    {
        
        if ($id == 0) {
            $item = $this->mainRepository->store($request->all());
            return redirect('edit' .  ucfirst($this->MainItem) . '/' . urlencode($item->id));
        } else {
            $item = $this->mainRepository->update($id, $request->all());
        }
        $arr = $this->getValues($item);
        $arr['fields'] = $arr;
        if (isset($this->arrToAddToView)){
            $arr=array_merge($arr,$this->arrToAddToView);
        }
        $action = $request->input('action');
        if ($action == 'Enveloppe') {
            $request = $this->Pdf->aperçu($id);
            return $request;
        }
        return view('edit' . ucfirst($this->MainItem), $arr);
    }
    
}
