<?php

namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;
use App\Models\ClientModel;

class SendMail extends Controller
{

    function sendMail() {
		$clients = new ClientModel;
		$lista=$clients->dboselectmail();

		

        $to = 'will.uquillasm@gmail.com';
        $subject = 'CALIFIK - Activación de Usuario';
        $message = '';
        
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setFrom('johnquezadahuayamave@gmail.com', 'Califi-K');
        
        $email->setSubject($subject);
        $email->setMessage($message);
        if ($email->send()) 
		{
            echo 'Credenciales enviadas';
        } 
		else 
		{
            $data = $email->printDebugger(['headers']);
            print_r($data);
        }
    }
}