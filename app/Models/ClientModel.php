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
    $sql = "EXEC [dbo].[clientSelect] @ruc = N'$id'";
    $query=$this->db->query($sql);
    $cliente=null; 
    $pase=true;
        foreach ($query->getResultArray() as $row) {
            if($pase){
                $cliente['ruc']=$row['ruc'];
                $cliente['razonSocial']=$row['razonSocial'];
                $cliente['nombreComercial']=$row['nombreComercial'];
                $cliente['correo']=$row['correo'];
                $cliente['vigencia']=$row['vigencia'];
                $cliente['consultor']=$row['consultor'];
                $cliente['consultorestext']=$row['consultorestext'];            
                $pase=false; 
            }
            $cliente['detalle'][]=array('id'=>$row['id'],'idruc'=>$row['idruc'],'Nombre'=>$row['Nombre'],'tipo'=>$row['tipo'],'precio'=>$row['precio'],'plazoRegistroPago'=>$row['plazoRegistroPago'],'plazoIngresoRegistro'=>$row['plazoIngresoRegistro'],'plazoCierreAuditoria'=>$row['plazoCierreAuditoria'],'plazoCalificacionEntregaInforme'=>$row['plazoCalificacionEntregaInforme'],'auditoriaCampoDespuesr2'=>$row['auditoriaCampoDespuesr2']);
        }
        return $cliente;
	}

    function dboinsert($row) {
       $sql = "EXEC [dbo].[clientInsert] @ruc = N'$row[ruc]', @razonSocial = N'$row[razonSocial]', @nombreComercial = N'$row[nombreComercial]',@user = N'$row[user]', @vigencia = $row[vigencia], @correo = N'$row[correo]', @password = N'$row[password]', @idCreador = $row[idCreador], @mail = N'$row[mail]', @consultor = '$row[consultor]', @terminos = N'$row[terminos]'";
       $result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dbosegmentacionInsert($id,$auditor,$array) {
        foreach ($array as &$valor) {
            $row=(array)$valor;
            $sql = "EXEC [dbo].[segmentacionInsert] @idruc = N'$id', @Nombre = N'$row[Nombre]', @tipo = N'$row[tipo]',@precio = N'$row[precio]', @plazoRegistroPago = $row[plazoRegistroPago], @plazoIngresoRegistro = N'$row[plazoIngresoRegistro]', @plazoCierreAuditoria = N'$row[plazoCierreAuditoria]', @plazoCalificacionEntregaInforme = $row[plazoCalificacionEntregaInforme], @auditoriaCampoDespuesr2 = N'$row[auditoriaCampoDespuesr2]', @usuario_creacion = $auditor";
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

    function dboselectb($id) {
        $sql = "SELECT TOP 1 [NUMERO_RUC] AS ruc
        ,[RAZON_SOCIAL] AS razonSocial
        ,[NOMBRE_COMERCIAL] AS nombreComercial
        ,'' as [user]
        ,'12' as vigencia
        ,'' as correo
        ,'0' as consultor
        ,'' as terminos
    FROM [Auditoria].[dbo].[empresas_ruc]
    WHERE [NUMERO_RUC]='$id' ORDER BY[RAZON_SOCIAL] DESC;";
        return $this->db->query($sql)->getRow();
    }

    function dboselectConsultores() {
        $sql = "SELECT [user],[id]
        FROM [Auditoria].[dbo].[users]
        where [idrol]=2 ORDER BY [user];";
        return $this->db->query($sql)->getResult();
    }
}