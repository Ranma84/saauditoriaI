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
		$sql = "EXEC clientInsert '$row[ruc]','$row[razonSocial]','$row[nombreComercial]','$row[user]','$row[password]','$row[idCreador]'";
        $result = $this->db->query($sql);	
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