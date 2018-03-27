<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function get($id = FALSE) {
		$this->db->select('T0.ID_CLIENTE, T0.NIT, T0.NOMBRE, T0.DIRECCION, T0.TELEFONO, T1.NOM_CIUDAD, T2.NOM_DEPARTAMENTO, T3.NOM_PAIS, T0.CUPO, T0.SALDO_CUPO, T0.PORCENTAJE_VISITAS, T0.ID_CLIENTE AS ACTIONS');
		$this->db->from('CLIENTE T0');
		$this->db->join('CIUDAD T1', 'T0.COD_CIUDAD = T1.COD_CIUDAD', 'lef');
		$this->db->join('DEPARTAMENTO T2', 'T1.COD_DEPARTAMENTO = T2.COD_DEPARTAMENTO', 'left');
		$this->db->join('PAIS T3', 'T2.COD_PAIS = T3.COD_PAIS', 'left');
		if ($id !== FALSE) {
			$this->db->where('T0.ID_CLIENTE', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

}