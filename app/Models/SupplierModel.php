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
}