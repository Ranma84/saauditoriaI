<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{

    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['idclient','user','email','telefono','estado','idrol','password','idCreador'];

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

    function dboinsert($row) {
		$sql = "EXECUTE userInsert '$row[user]','$row[email]','$row[telefono]','$row[password]','1','$row[idCreador]',,'$row[view]'";
		$result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dboupdate($row) {
		$sql = 'CALL userUpdate(?,?,?,?,?,?,?,?)';
		$result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}

    function dbodelete($row) {
		$sql = 'CALL userDelete(?,?)';
		$result = $this->db->query($sql,$row);	
		if ($result) {
			return true;
		}
		return false;
	}
}
