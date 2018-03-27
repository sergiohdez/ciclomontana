<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendedores_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get($id = FALSE) {
		$this->db->select('COD_VENDEDOR, NOM_VENDEDOR');
		$this->db->from('VENDEDOR');
		if ($id !== FALSE) {
			$this->db->where('COD_VENDEDOR', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}