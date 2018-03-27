<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
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
		$this->db->select('T0.SEQ_MATRIZ_RIESGO, T0.NOMBRE_MATRIZ, T0.SEQ_MACRO_PROCESO, T1.NOMBRE_MACRO_PROCESO, T1.INICIALES_MACRO_PROCESO, T0.USR_ENCARGADO, T3.NOMBRE_FUNC AS NOMBRE_ENCARGADO, T0.ACTIVO, T0.SEQ_MATRIZ_RIESGO AS ACTIONS');
		$this->db->from('CWT.ADMR_MATRIZ_RIESGOS T0');
		$this->db->join('CWT.ADMR_MACRO_PROCESOS T1', 'T0.SEQ_MACRO_PROCESO = T1.SEQ_MACRO_PROCESO');
		$this->db->join('CWT.ADMR_USUARIOS_MACRO_PROCESOS T2', 'T0.SEQ_MACRO_PROCESO = T2.SEQ_MACRO_PROCESO AND T2.COD_USUARIO = \'' . $this->session->userdata('username') . '\'', 'left');
		$this->db->join('CWT.ADMR_DATOS_FUNCIONARIO T3', 'T0.USR_ENCARGADO = T3.COD_FUNC', 'left');
		$this->db->group_start();
		$this->db->where('T0.USR_ENCARGADO', $this->session->userdata('username'));
		$this->db->or_where('T2.COD_USUARIO', $this->session->userdata('username'));
		$this->db->group_end();
		$this->db->group_start();
		$this->db->like('T0.NOMBRE_MATRIZ', $search['value'], 'both');
		$this->db->or_like('T1.NOMBRE_MACRO_PROCESO', $search['value'], 'both');
		$this->db->or_like('T1.INICIALES_MACRO_PROCESO', $search['value'], 'both');
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
}