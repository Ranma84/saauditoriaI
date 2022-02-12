<?php

namespace App\Controllers;
use App\Models\FormModel;
use CodeIgniter\Controller;
class SendMail extends Controller
{
    public function index() 
	{
        return view('form_view');
    }
    function sendMail() { 
        $to = 'will.uquillasm@gmail.com';
        $subject = 'CALIFIK - Activación de Usuario';
        $message = '<div style="font-family:Helvetica;text-align:justify;display:inline-block;padding:10px 20px;background:#f4f4f4;border-radius:10px;border:3px solid;font-size:12px;border-top-color:#5d998d;border-right-color:#5d998d;border-bottom-color:#a2cc47;border-left-color:#a2cc47;max-width:85%;min-width:85%">    		
		<p>
			Para acceder al Sistema de Calificación de Proveedores <strong>"CALIFIK"</strong>, se le han generado los siguientes accesos:
		</p>
		<p>
			</p>
			<div>
				<strong><span class="il">Usuario</span>: </strong><span>wuquillas</span>
			</div>
			<div>
				<strong>Contraseña: </strong><span>61f9a0fb6bb1a</span>
			</div>
			<div style="margin-top:40px;margin-bottom:40px">
				<strong>Acceder al link: </strong><a href="https://califik.com.ec/" target="_blank" data-saferedirecturl="https://califik.com.ec/">
					Ingresar al Sistema
				</a>
			</div>
		<p></p>
		<br>
		<p>
			Saludos,
		</p>
		<p>
			<strong>EQUIPO DE CALIFIK</strong>
		</p>
</div>';
        
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