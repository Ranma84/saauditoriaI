<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\UserModel;
 
 
class Register extends BaseController
{
    use ResponseTrait;
 
    public function index()
    {
        $rules = [
            'email' => ['rules' => 'required|min_length[4]|max_length[255]|valid_email|is_unique[users.email]'],
			'user' => ['rules' => 'required|min_length[4]|max_length[255]|is_unique[users.user]'],
            'password' => ['rules' => 'required|min_length[8]|max_length[255]'],
            'confirm_password'  => [ 'label' => 'confirm password', 'rules' => 'matches[password]']
        ];
        if($this->validate($rules)){
            $model = new UserModel();
            $data = [
                'email'    => $this->request->getVar('email'),
				'user'    => $this->request->getVar('user'),
                'telefono'    => $this->request->getVar('telefono'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            ];
			if ($model->save($data)) {
			 return $this->respond(['message' => 'Registered Successfully'], 200);
			} else {
			 return $this->fail(print_r($model->errors()), 410);
			} 
        }else{
            $response = [
                'errors' => $this->validator->getErrors(),
                'message' => 'Invalid Inputs'
            ];
            return $this->fail($response , 409);
             
        }
            
    }
}