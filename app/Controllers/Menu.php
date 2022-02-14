<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\MenuModel;

class Menu extends BaseController
{
    
    use ResponseTrait;
    
    
    public function index()
    {
        $rol2 = $this->request->getVar('rol');
        $MenuModel = new MenuModel();
        $menus = $MenuModel->where('idrol', $rol2) ->findAll();
        if(empty($menus)) {
            return $this->respond(['error' => 'No hay menus para este rol'], 401);
        }
        return $this->respond(['menus' => $menus], 200);       
    }

    public function principal()
    {
        $item[] = array('is'=>'item','icon'=>'<IoMdKeypad />','title'=>'Control Financiero','to'=>'/Control-Financiero');
        $item[] = array('is'=>'item','icon'=>'<IoMdKeypad />','title'=>'Requisitos Auditables','to'=>'/auditable-requirements');
        $menus = array('is'=>'menu','menu'=>$item);
        if(empty($menus)) {
            return $this->respond(['error' => 'No hay menus para este rol'], 401);
        }
        return $this->respond(['menus' => $menus], 200);       
    }
}
