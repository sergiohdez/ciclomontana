<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Departamentos_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get($pid = FALSE, $id = FALSE) {
		$this->db->select('COD_DEPARTAMENTO, NOM_DEPARTAMENTO');
		$this->db->from('DEPARTAMENTO');
		if ($pid !== FALSE) {
			$this->db->where('COD_PAIS', $pid);
		}
		if ($id !== FALSE) {
			$this->db->where('COD_DEPARTAMENTO', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}