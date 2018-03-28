<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function insert($data = array()) {
		if (count($data) > 0) {
			return $this->db->insert('CLIENTE', $data);
		}
		return FALSE;
	}

	public function update($data = array()) {
		if (count($data) > 0) {
			$this->db->where('ID_CLIENTE', $data['ID_CLIENTE']);
			return $this->db->update('CLIENTE', $data);
		}
		return FALSE;
	}

	public function delete($data = array()) {
		if (count($data) > 0) {
			$this->db->where('ID_CLIENTE', $data['ID_CLIENTE']);
			return $this->db->delete('CLIENTE');
		}
		return FALSE;
	}

	public function get($id = FALSE) {
		$this->db->select('T0.ID_CLIENTE, T0.NIT, T0.NOMBRE, T0.DIRECCION, T0.TELEFONO, T0.COD_CIUDAD, T1.NOM_CIUDAD, T1.COD_DEPARTAMENTO, T2.NOM_DEPARTAMENTO, T2.COD_PAIS, T3.NOM_PAIS, T0.CUPO, T0.SALDO_CUPO, T0.PORCENTAJE_VISITAS, T0.ID_CLIENTE AS ACTIONS');
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

    public function get_dt() {
        $response = array();

		$draw = $this->input->post('draw');
		$columns = $this->input->post('columns');
		$order = $this->input->post('order');
		$start = $this->input->post('start');
		$length = $this->input->post('length');
		$search = $this->input->post('search');

		$this->db->start_cache();
		$this->db->select('T0.ID_CLIENTE, T0.NIT, T0.NOMBRE, T0.DIRECCION, T0.TELEFONO, T0.COD_CIUDAD, T1.NOM_CIUDAD, T1.COD_DEPARTAMENTO, T2.NOM_DEPARTAMENTO, T2.COD_PAIS, T3.NOM_PAIS, T0.CUPO, T0.SALDO_CUPO, T0.PORCENTAJE_VISITAS, T0.ID_CLIENTE AS ACTIONS');
		$this->db->from('CLIENTE T0');
		$this->db->join('CIUDAD T1', 'T0.COD_CIUDAD = T1.COD_CIUDAD', 'lef');
		$this->db->join('DEPARTAMENTO T2', 'T1.COD_DEPARTAMENTO = T2.COD_DEPARTAMENTO', 'left');
		$this->db->join('PAIS T3', 'T2.COD_PAIS = T3.COD_PAIS', 'left');
		$this->db->group_start();
		$this->db->like('T0.NOMBRE', $search['value'], 'both');
		$this->db->or_like('T1.NOM_CIUDAD', $search['value'], 'both');
		$this->db->or_like('T2.NOM_DEPARTAMENTO', $search['value'], 'both');
		$this->db->or_like('T3.NOM_PAIS', $search['value'], 'both');
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
		return $this->db->count_all('CLIENTE');
	}

}