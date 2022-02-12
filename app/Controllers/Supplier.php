<?php
 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\SupplierModel;
use \Firebase\JWT\JWT;

class Supplier extends BaseController
{
	use ResponseTrait;	
      
    public function index()
    {
        $supplier = new SupplierModel;
        return $this->respond($supplier->select('ruc,razonSocial,nombreComercial,nombrePersonaContacto,TelefonoPersonaContacto')->findAll(), 200);
    }
	
	public function get($id=null){
        $supplier = new SupplierModel;
        $lista=$supplier->dboselect($id);
        if(!empty($lista)){
            return $this->respond($lista, 200);
        }
        return $this->respond(['error' => 'No hay datos'], 401);    
    }

    public function delete(){
        $rules = [
            'id' => ['rules' => 'required'],
            'idDelete' => ['rules' => 'required']
        ];
        if($this->validate($rules)){
            $SupplierModel = new SupplierModel();
            $id = $this->request->getVar('id');
            $idDelete=$this->request->getVar('idDelete'); 
            $data = [
                'id'=> $this->request->getVar('id'),
                'idDelete'=> $this->request->getVar('idDelete')
            ];
            if(isset($data['idDelete']) && !empty($data['idDelete'])){
                 $SupplierModel->dbodelete($id, $data);
                return $this->respond(['estado' => 'ok'], 200);
            }
            return $this->fail(print_r($model->errors()), 410);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);  
    }
	}

    public function update(){
        $rules = [
            'id' => ['rules' => 'required'],
            'user' => ['rules' => 'required|min_length[4]|max_length[255]'],
			'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email'],
            'telefono' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'password' => ['rules' => 'min_length[4]|max_length[100]'],
            'idUpdate' => [ 'label' => 'required']
        ];
        if($this->validate($rules)){
            $SupplierModel = new SupplierModel();
            $id = $this->request->getVar('id');
            $idcliente=$this->request->getVar('idclient');
            
            $data = [
                'id'=> $id,
                'user'=> $this->request->getVar('user'),
                'email' => $this->request->getVar('email'),
                'telefono'  => $this->request->getVar('telefono'),
                'ididUpdate'  => $this->request->getVar('idUpdate')
            ];
            if(isset($data['user']) && !empty($data['user'])){
                if(!empty($password)){
                    $data['password']=password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
                }
                else{
                    $data['password']='';       
                }
                if(!empty($idcliente)){
                    $data['idclient']=$idcliente;
                }
                else{
                    $data['idclient']='';        
                }
                $SupplierModel->dboupdate($data);
                return $this->respond(['estado' => 'ok'], 200);
            }
            return $this->fail(print_r($model->errors()), 410);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
        }
	}

    public function insert(){
        $rules = [
            'ruc' => ['rules' => 'required|min_length[4]|max_length[255]'],
			'razonSocial' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'nombreComercial' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'user' => ['rules' => 'required|min_length[4]|max_length[100]'],
            'password' => [ 'label' => 'required']
        ];
        if($this->validate($rules)){
            $SupplierModel = new SupplierModel();
            $data = [
                'ruc'=> $this->request->getVar('ruc'),
                'razonSocial' => $this->request->getVar('razonSocial'),
                'nombreComercial'  => $this->request->getVar('nombreComercial'),
                'user'  => $this->request->getVar('user'),
                'password'  => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'idCreador'  => 0 //$this->request->getVar('idCreador')
            ];
            if(isset($data['ruc']) && !empty($data['ruc'])){
                $SupplierModel->dboinsert($data);
                return $this->respond(['estado' => 'ok'], 200);
            }
            return $this->fail(print_r($model->errors()), 410);
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
        }
    }

}