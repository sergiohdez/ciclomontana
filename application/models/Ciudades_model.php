<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ciudades_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get($did = FALSE, $id = FALSE) {
		$this->db->select('COD_CIUDAD, NOM_CIUDAD');
		$this->db->from('CIUDAD');
		if ($did !== FALSE) {
			$this->db->where('COD_DEPARTAMENTO', $did);
		}
		if ($id !== FALSE) {
			$this->db->where('COD_CIUDAD', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}