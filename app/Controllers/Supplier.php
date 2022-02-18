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
	
    function getdb($id) {            
            $supplier = new SupplierModel;
            $lista=$supplier->dboselectb($id); 
            if(!empty($lista)){
                return $this->respond(['supplier' => $lista], 200);
            }
            return $this->respond(['error' => 'No hay datos'], 401); 
        }

    function dboselectcliente() {
        $supplier = new SupplierModel;
        $lista=$supplier->dboselectcliente(); 
        if(!empty($lista)){
            return $this->respond($lista, 200);
        }
        return $this->respond(['error' => 'No hay datos'], 401); 
    }

    function dboselectsegmento() {
        $nombre=$this->request->getVar('nombre');
        $supplier = new SupplierModel;
        $lista=$supplier->dboselectsegmento($nombre); 
        if(!empty($lista)){
            return $this->respond($lista, 200);
        }
        return $this->respond(['error' => 'No hay datos'], 401); 
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
            'ruc' => ['rules' => 'max_length[255]']
        ];
        if($this->validate($rules)){
            $SupplierModel = new SupplierModel();

            $password=$this->generador();
            $client=$this->request->getVar('client');
            $correo = ['password' => $password,'user'=>$this->request->getVar('ruc')];
            $view= view('mail_view_createcliente', $correo);

            $data = [
                'ruc'=> $this->request->getVar('ruc')
                ,'idclient'=> $this->request->getVar('idclient')
                ,'idSegmento'=> $this->request->getVar('idSegmento')
                ,'razonSocial'=> $this->request->getVar('razonSocial')
                ,'nombreComercial'=> $this->request->getVar('nombreComercial')
                ,'direccion'=> $this->request->getVar('direccion')
                ,'idPais'=> $this->request->getVar('idPais')
                ,'provincia'=> $this->request->getVar('provincia')
                ,'ciudad'=> $this->request->getVar('ciudad')
                ,'direccionFactura'=> $this->request->getVar('direccionFactura')
                ,'tipoContribuyente'=> $this->request->getVar('tipoContribuyente')
                ,'actividadEmpresa'=> $this->request->getVar('actividadEmpresa')
                ,'actividadEspecifica'=> $this->request->getVar('actividadEspecifica')
                ,'telefono'=> $this->request->getVar('telefono')
                ,'fechaFacturacion'=> $this->request->getVar('fechaFacturacion')
                ,'nombrePersonaContacto'=> $this->request->getVar('nombrePersonaContacto')
                ,'cargoPersonaContacto'=> $this->request->getVar('cargoPersonaContacto')
                ,'TelefonoPersonaContacto'=> $this->request->getVar('TelefonoPersonaContacto')
                ,'mailPersonaContacto'=> $this->request->getVar('mailPersonaContacto')
                ,'codigoActivacion'=> $this->request->getVar('codigoActivacion')
                ,'created_user'=> 1
                ,'mailPersonaFacturacion'=> $this->request->getVar('mailPersonaFacturacion')
                ,'TelefonoPersonaFacturacion'=> $this->request->getVar('TelefonoPersonaFacturacion')
                ,'CargoPersonaFacturacion'=> $this->request->getVar('CargoPersonaFacturacion')
                ,'NombrePersonaFacturacion'=> $this->request->getVar('NombrePersonaFacturacion')
                ,'NombrePersonaauditoria'=> $this->request->getVar('NombrePersonaauditoria')
                ,'mailPersonaauditoria'=> $this->request->getVar('mailPersonaauditoria')
                ,'TelefonoPersonaauditoria'=> $this->request->getVar('TelefonoPersonaauditoria')
                ,'CargoPersonaauditoria'=> $this->request->getVar('CargoPersonaauditoria')
                ,'idCreador'=> 1
                ,'mail'=> $view
                ,'password' =>$password
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