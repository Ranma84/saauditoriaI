<?php

namespace App\Models;

use CodeIgniter\Model;

class ClientModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'client';
    protected $primaryKey       = 'ruc';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ruc','razonSocial','nombreComercial'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    function dboselect($id) {
        $builder = $this->db->table('client');
        $builder->select('client.ruc,client.razonSocial,client.nombreComercial,users.user');
        $builder->join('users', 'users.idclient = client.ruc');
        $builder->where('client.ruc',$id);
        return $builder->get()->getRow(); 
	}

    function dboinsert($row) {
       $sql = "EXEC [dbo].[clientInsert] @ruc = N'$row[ruc]', @razonSocial = N'$row[razonSocial]', @nombreComercial = N'$row[nombreComercial]',@user = N'$row[user]', @vigencia = $row[vigencia], @correo = N'$row[correo]', @password = N'$row[password]', @idCreador = $row[idCreador], @mail = N'$row[mail]', @consultor = $row[consultor], @terminos = N'$row[terminos]'";
       $result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dbosegmentacionInsert($id,$auditor,$array) {
        foreach ($array as &$valor) {
            $row=(array)$valor;
            $sql = "EXEC [dbo].[segmentacionInsert] @idruc = N'$id', @Nombre = N'$row[segmentos]', @tipo = N'r2',@precio = N'$row[costo]', @plazoRegistroPago = $row[FAC], @plazoIngresoRegistro = N'$row[cyei]', @plazoCierreAuditoria = N'$row[FDRegistro]', @plazoCalificacionEntregaInforme = $row[FCAuditoria], @auditoriaCampoDespuesr2 = N'$row[FCEInfome]', @usuario_creacion = $auditor";
            $result = $this->db->query($sql,$row);
        }
         if ($result) {
             return true;
         }
         return false;
     }

    function dboupdate($row) {
		$sql = 'EXEC clientUpdate(?,?,?,?,?,?,?,?)';	
        


        $result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dbodelete($row) {
		$sql = 'EXEC clientDelete(?,?)';
		$result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dboenviomail() {
		$sql = 'EXEC enviomail';
		$result = $this->db->query($sql);	
		if ($result) {
			return true;
		}
		return false;
	}
}