<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function getVisitasCiudad() {
        $this->db->select('T2.NOM_CIUDAD, COUNT(*) AS CANTIDAD', FALSE);
		$this->db->from('VISITA T0');
        $this->db->join('CLIENTE T1', 'T0.ID_CLIENTE = T1.ID_CLIENTE', 'left');
		$this->db->join('CIUDAD T2', 'T2.COD_CIUDAD = T1.COD_CIUDAD', 'lef');
        $this->db->group_by('T2.NOM_CIUDAD');
		$query = $this->db->get();
		return $query->result_array();
    }

    public function getCuposCliente($id = FALSE) {
        if ($id !== FALSE) {
            $this->db->select('T0.FECHA, T0.CUPO_CLIENTE');
            $this->db->from('VISITA T0');
            $this->db->where('T0.ID_CLIENTE', $id);
            $this->db->order_by('T0.FECHA','ASC');
            $query = $this->db->get();
            return $query->result_array();
        }
        return array();
    }

}