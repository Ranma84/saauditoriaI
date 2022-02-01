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
        return $this->respond($users->select('user,telefono,email')->findAll(), 200);
    }

}