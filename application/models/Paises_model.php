<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paises_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get($id = FALSE) {
		$this->db->select('COD_PAIS, NOM_PAIS');
		$this->db->from('PAIS');
		if ($id !== FALSE) {
			$this->db->where('COD_PAIS', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}