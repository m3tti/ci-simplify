<?php

namespace App\Models;

use CodeIgniter\Model;

class ActiveModel extends Model
{
	protected $table            = '';
	protected $primaryKey       = 'id';
	protected $useAutoIncrement = true;
	protected $returnType       = 'array';
	protected $useSoftDeletes   = false;
	protected $protectFields    = true;
	protected $allowedFields    = [];

	protected bool $allowEmptyInserts = false;

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
	protected $afterFind      = [
		'loadDependencies',
	];
	protected $beforeDelete   = [];
	protected $afterDelete    = [];

	protected $withDeps = [];

	public function with($tablename)
	{
		$this->withDeps[] = $tablename;
		return $this;
	}

	public function hasWith($name)
	{
		return in_array($name, $this->withDeps);
	}

	protected function loadDependencies($data)
	{
		$payload = &$data['data'];
		if (is_array($payload)) {
			if (array_is_list($payload)) {
				foreach ($payload as &$item) {
					$item = $this->attachDependency($item);
				}
			} else {
				$payload = $this->attachDependency($payload);
			}
		}

		return $data;
	}

	protected function attachDependency($item)
	{
		return $item;
	}
}
