<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function insert($data = array()) {
		if (count($data) > 0) {
			return $this->db->insert('VISITA', $data);
		}
		return FALSE;
	}

	public function update($data = array()) {
		if (count($data) > 0) {
			$this->db->where('ID_VISITA', $data['ID_VISITA']);
			return $this->db->update('VISITA', $data);
		}
		return FALSE;
	}

	public function delete($data = array()) {
		if (count($data) > 0) {
			$this->db->where('ID_VISITA', $data['ID_VISITA']);
			return $this->db->delete('VISITA');
		}
		return FALSE;
	}

	public function get($id = FALSE) {
		$this->db->select('T0.ID_VISITA, T0.FECHA, T0.COD_VENDEDOR, T1.NOM_VENDEDOR, T0.VALOR_NETO, T0.VALOR_VISITA, T0.ID_CLIENTE, T2.NOMBRE, T0.OBSERVACIONES, T0.CUPO_CLIENTE, T0.ID_VISITA AS ACTIONS');
		$this->db->from('VISITA T0');
		$this->db->join('VENDEDOR T1', 'T0.COD_VENDEDOR = T1.COD_VENDEDOR', 'lef');
		$this->db->join('CLIENTE T2', 'T0.ID_CLIENTE = T2.ID_CLIENTE', 'left');
		if ($id !== FALSE) {
			$this->db->where('T0.ID_VISITA', $id);
		}
		$query = $this->db->get();
		return $query->result_array();
	}

    public function get_dt() {
        $response = array();

		$draw = $this->input->post('draw');
		$columns = $this->input->post('columns');
		$order = $this->input->post('order');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search');

		$this->db->start_cache();
		$this->db->select('T0.ID_VISITA, T0.FECHA, T0.COD_VENDEDOR, T1.NOM_VENDEDOR, T0.VALOR_NETO, T0.VALOR_VISITA, T0.ID_CLIENTE, T2.NOMBRE, T0.OBSERVACIONES, T0.CUPO_CLIENTE, T0.ID_VISITA AS ACTIONS');
		$this->db->from('VISITA T0');
		$this->db->join('VENDEDOR T1', 'T0.COD_VENDEDOR = T1.COD_VENDEDOR', 'lef');
		$this->db->join('CLIENTE T2', 'T0.ID_CLIENTE = T2.ID_CLIENTE', 'left');
		$this->db->group_start();
		$this->db->like('T1.NOM_VENDEDOR', $search['value'], 'both');
		$this->db->or_like('T2.NOMBRE', $search['value'], 'both');
		$this->db->or_like('T0.OBSERVACIONES', $search['value'], 'both');
		$this->db->or_like('T0.ID_VISITA', $search['value'], 'both');
		$this->db->or_like('T0.FECHA', $search['value'], 'both');
		$this->db->group_end();
		$this->db->order_by($columns[$order[0]['column']]['name'], $order[0]['dir']);
		$data_filter = $this->db->get()->result_array();
		$this->db->limit($length, $start);
		$data = $this->db->get()->result_array();
		$this->db->flush_cache();
		$this->db->stop_cache();

		$response['draw'] = $draw;
		$response['recordsTotal'] = $this->get_total();
		$response['recordsFiltered'] = count($data_filter);
		$response['data'] = $data;

		return $response;
	}
	
	public function get_total() {
		return $this->db->count_all('VISITA');
	}

	public function getVisitasCliente($id = FALSE) {
		$rta = array();
		if ($id !== FALSE) {
			$this->db->select('T0.ID_VISITA, T0.FECHA, T0.COD_VENDEDOR, T1.NOM_VENDEDOR, T0.VALOR_NETO, T0.VALOR_VISITA, T0.ID_CLIENTE, T2.NOMBRE, T0.OBSERVACIONES, T0.CUPO_CLIENTE, T0.ID_VISITA AS ACTIONS');
			$this->db->from('VISITA T0');
			$this->db->join('VENDEDOR T1', 'T0.COD_VENDEDOR = T1.COD_VENDEDOR', 'lef');
			$this->db->join('CLIENTE T2', 'T0.ID_CLIENTE = T2.ID_CLIENTE', 'left');
			$this->db->where('T0.ID_CLIENTE', $id);
			$query = $this->db->get();
			$rta = $query->result_array();
		}
		return $rta;
	}
}