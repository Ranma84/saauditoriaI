<?php
 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientModel;
use \Firebase\JWT\JWT;

class Client extends BaseController
{
	use ResponseTrait;	
      
    public function index()
    {
        $clients = new ClientModel;
        return $this->respond($clients->select('ruc,razonSocial,nombreComercial')->findAll(), 200);
    }
	
	public function get($id=null){
        $clients = new ClientModel;
        $lista=$clients->dboselect($id);
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
            $ClientModel = new ClientModel();
            $id = $this->request->getVar('id');
            $idDelete=$this->request->getVar('idDelete'); 
            $data = [
                'id'=> $this->request->getVar('id'),
                'idDelete'=> $this->request->getVar('idDelete')
            ];
            if(isset($data['idDelete']) && !empty($data['idDelete'])){
                 $ClientModel->dbodelete($id, $data);
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
            $ClientModel = new ClientModel();
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
                $ClientModel->dboupdate($data);
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
            'client[ruc]' => ['rules' => 'required|min_length[4]|max_length[255]'],
			'razonSocial' => ['rules' => 'required|min_length[2]|max_length[255]'],
            'nombreComercial' => ['rules' => 'required|min_length[2]|max_length[255]']
        ];
        if(!$this->validate($rules)){
            $ClientModel = new ClientModel();
            
            $password=$this->generador();
            $client=$this->request->getVar('client');
            $user=$client->user;
            $correo = ['password' => $password,'user'=>$user];
            $view= '';//view('mail_view_createcliente', $correo);

            $data = [
                'ruc'=> $client->ruc,
                'razonSocial' => $client->razonSocial,
                'nombreComercial'  => $client->nombreComercial,
                'user'  => $client->ruc,
                'vigencia'  => $client->vigencia,
                'correo'  => $client->correo,
                'password'  => password_hash($password, PASSWORD_DEFAULT),
                'idCreador'  => 0,
                'viewmail'  => $view,
                'mail'  => '',
                'consultor'  =>$client->consultor,
                'terminos'  => $client->terminos
            ];
            $rowsData=$this->request->getVar('rowsData');            
            if(isset($data['ruc']) && !empty($data['ruc'])){
                $ClientModel->dboinsert($data);
                $ClientModel->dbosegmentacionInsert($client->ruc,$client->consultor,$rowsData);
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

    public function generador(){
        $comb = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!@#$%&/()=-+?[]';
        $pass = ''; 
        $combLen = strlen($comb) - 1; 
        for ($i = 0; $i < 8; ++$i) {
            $n = rand(0, $combLen);
            $pass.=$comb[$n];
        }
        return $pass;
    }

}