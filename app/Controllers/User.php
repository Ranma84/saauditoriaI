<?php
 
namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
use \Firebase\JWT\JWT;

class User extends BaseController
{
	use ResponseTrait;	
      
    public function index()
    {
        $users = new UserModel;
        return $this->respond($users->select('id,user,telefono,email')->findAll(), 200);
    }
	
	public function get($id=null){
        $users = new UserModel;
        $lista=$users->select('id,user,telefono,email')->where('id', $id)->first();
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
            $userModel = new UserModel();
            $id = $this->request->getVar('id');
            $idDelete=$this->request->getVar('idDelete'); 
            $data = [
                'id'=> $this->request->getVar('id'),
                'idDelete'=> $this->request->getVar('idDelete')
            ];
            if(isset($data['idDelete']) && !empty($data['idDelete'])){
                 $userModel->dbodelete($id, $data);
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
            $userModel = new UserModel();
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
                $userModel->dboupdate($data);
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

    public function insert(){
        $rules = [
            'user' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'telefono' => ['rules' => 'required|min_length[4]|max_length[255]'],
            'email' => ['rules' => 'required|min_length[4]|max_length[100]']
        ];
        if($this->validate($rules)){
            $userModel = new UserModel();
            $password=$this->generador();
            $rol=$this->request->getVar('idrol');
            $user=$this->request->getVar('user');
            $correo = ['password' => $password,'user'=>$user,'rol'=>$rol];
            $view=view('mail_view_createcliente', $correo);
            $data = [
                'user'=> $this->request->getVar('user'),
                'email' => $this->request->getVar('email'),
                'telefono'  => $this->request->getVar('telefono'),
                'idrol'  => $this->request->getVar('idrol'),
                'password'  => password_hash($password, PASSWORD_DEFAULT),
                'idCreador'  => $this->request->getVar('idCreador'),
                'view' =>$view
            ];
            if(isset($data['user']) && !empty($data['user'])){
                $userModel->dboinsert($data);
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