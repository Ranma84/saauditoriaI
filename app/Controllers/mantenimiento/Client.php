<?php
 
namespace App\Controllers;
 
use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use App\Models\ClientModel;
use \Firebase\JWT\JWT;

class Login extends BaseController
{
    use ResponseTrait;
     
    public function index()
    {
        $clientModel = new ClientModel();
        $cliente = $clientModel->findAll();
    }
 
}