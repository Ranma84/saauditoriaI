<?php

namespace App\Models;

use CodeIgniter\Model;

class SupplierModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'supplier';
    protected $primaryKey       = 'ruc';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['ruc,razonSocial','nombreComercial','nombrePersonaContacto','TelefonoPersonaContacto'];

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
        $sql = "SELECT [supplier].[ruc]
        ,[supplier].[idclient]
        ,[client].razonSocial AS ClientRazonSocial
        ,[supplier].[idSegmento]
        ,[Segmentacion].[Nombre] AS SegmentacionNombre 
        ,[supplier].[razonSocial]
        ,[supplier].[nombreComercial]
        ,[supplier].[direccion]
        ,[supplier].[idPais]
        ,[supplier].[provincia]
        ,[supplier].[ciudad]
        ,[supplier].[direccionFactura]
        ,[supplier].[tipoContribuyente]
        ,[supplier].[actividadEmpresa]
        ,[supplier].[actividadEspecifica]
        ,[supplier].[telefono]
        ,[supplier].[fechaFacturacion]
        ,[supplier].[nombrePersonaContacto]
        ,[supplier].[cargoPersonaContacto]
        ,[supplier].[TelefonoPersonaContacto]
        ,[supplier].[mailPersonaContacto]
        ,[supplier].[codigoActivacion]
        ,[supplier].[estado]
        ,[supplier].[mailPersonaFacturacion]
        ,[supplier].[TelefonoPersonaFacturacion]
        ,[supplier].[CargoPersonaFacturacion]
        ,[supplier].[NombrePersonaFacturacion]
        ,[supplier].[NombrePersonaauditoria]
        ,[supplier].[mailPersonaauditoria]
        ,[supplier].[TelefonoPersonaauditoria]
        ,[supplier].[CargoPersonaauditoria]
    FROM [Auditoria].[dbo].[supplier]
    INNER JOIN [dbo].[client] ON  [supplier].[idclient]=[client].ruc
    LEFT JOIN [dbo].[Segmentacion] ON [Segmentacion].[id]=[supplier].[idSegmento]
    WHERE [supplier].[ruc]='$id';";
        return $this->db->query($sql)->getRow();
    }

    function dboselectb($id) {
        $sql = "SELECT TOP 1 [NUMERO_RUC] AS ruc
        ,[RAZON_SOCIAL] AS razonSocial
        ,[NOMBRE_COMERCIAL] AS nombreComercial
        ,[ESTADO_CONTRIBUYENTE] 
        ,[CLASE_CONTRIBUYENTE]
        ,[FECHA_INICIO_ACTIVIDADES]
        ,[FECHA_ACTUALIZACION]
        ,[FECHA_SUSPENSION_DEFINITIVA]
        ,[FECHA_REINICIO_ACTIVIDADES]
        ,[OBLIGADO]
        ,[TIPO_CONTRIBUYENTE] AS tipoContribuyente
        ,[NUMERO_ESTABLECIMIENTO]
        ,[NOMBRE_FANTASIA_COMERCIAL]
        ,[CALLE] AS direccionFactura
        ,[INTERSECCION]
        ,[ESTADO_ESTABLECIMIENTO]
        ,[DESCRIPCION_PROVINCIA] AS provincia
        ,[DESCRIPCION_CANTON] AS ciudad
        ,[DESCRIPCION_PARROQUIA]
        ,[CODIGO_CIIU]
        ,[ACTIVIDAD_ECONOMICA] AS actividadEmpresa
        ,[ACTIVIDAD_ECONOMICA] AS actividadEspecifica
        ,'ECUADOR' AS idPais
        ,'' AS telefono
        ,'' AS fechaFacturacion
        ,'' AS nombrePersonaContacto
        ,'' AS cargoPersonaContacto
        ,'' AS TelefonoPersonaContacto
        ,'' AS mailPersonaContacto
    FROM [Auditoria].[dbo].[empresas_ruc]
    WHERE [NUMERO_RUC]='$id' ORDER BY[RAZON_SOCIAL] DESC;";
        return $this->db->query($sql)->getRow();
    }

    function dboselectcliente() {
        $sql = "SELECT  [razonSocial] AS name, [ruc] AS id  FROM [Auditoria].[dbo].[client] WHERE [estado]=1 ORDER BY razonSocial ASC;";
        return $this->db->query($sql)->getResult();
    }

    function dboinsert($row) {
        $sql = "[dbo].[supplierInsert] @ruc = N'$row[ruc]',@idclient = N'$row[idclient]',@idSegmento = $row[idSegmento],@razonSocial = N'$row[razonSocial]', @nombreComercial = N'$row[nombreComercial]',@direccion = N'$row[direccion]', @idPais = $row[idPais],@provincia = N'$row[provincia]', @ciudad = N'$row[ciudad]',@direccionFactura = N'$row[direccionFactura]', @tipoContribuyente = N'$row[tipoContribuyente]',@actividadEmpresa = N'$row[actividadEmpresa]', @actividadEspecifica = N'$row[actividadEspecifica]',@telefono = N'$row[telefono]', @fechaFacturacion = N'$row[fechaFacturacion]',@nombrePersonaContacto = N'$row[nombrePersonaContacto]', @cargoPersonaContacto = N'$row[cargoPersonaContacto]',@TelefonoPersonaContacto = N'$row[TelefonoPersonaContacto]', @mailPersonaContacto = N'$row[mailPersonaContacto]',@codigoActivacion = N'$row[codigoActivacion]', @created_user = N'$row[created_user]',@mailPersonaFacturacion = N'$row[mailPersonaFacturacion]',@TelefonoPersonaFacturacion = N'$row[TelefonoPersonaFacturacion]',@CargoPersonaFacturacion = N'$row[CargoPersonaFacturacion]',@NombrePersonaFacturacion = N'$row[NombrePersonaFacturacion]',@NombrePersonaauditoria = N'$row[NombrePersonaauditoria]',@mailPersonaauditoria = N'$row[mailPersonaauditoria]',@TelefonoPersonaauditoria = N'$row[TelefonoPersonaauditoria]',@CargoPersonaauditoria = N'$row[CargoPersonaauditoria]',@idCreador = $row[idCreador],@mail = N'$row[mail]',@password = N'$row[password]';";
        $result = $this->db->query($sql);
        if ($result) {
			return true;
		}
		return false;
    }

    function dboselectsegmento($id) {
        $sql = "SELECT [id],[Nombre]
        FROM [Auditoria].[dbo].[Segmentacion]
        INNER JOIN [dbo].[client] ON [Segmentacion].idruc=[client].ruc
        WHERE [client].[razonSocial]='$id'";
        return $this->db->query($sql)->getResult();
        
    }


    
}