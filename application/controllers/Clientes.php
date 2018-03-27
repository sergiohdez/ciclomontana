<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model', 'clientes_model');
        $this->load->model('ciudades_model', 'cliudades_model');
        $this->load->model('departamentos_model', 'departamentos_model');
        $this->load->model('paises_model', 'paises_model');
    }
    
    public function index() {
        $data = array();
        $data['title'] = 'Clientes';
        $this->_get_views($data);
		$data['success'] = $this->session->flashdata('success');
		$data['errors'] = $this->session->flashdata('errors');
        $data['content'] = $this->load->view('clientes/clientes_home', $data, TRUE);
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		$this->load->view('layouts/app', $data);
    }

	public function data() {
		$data = $this->clientes_model->get_dt();
		if (isset($data['data'])) {
			foreach ($data['data'] as $k => $e) {
				if (isset($e['NIT'])) {
					$data['data'][$k]['NIT'] = $this->encryption->decrypt($e['NIT']);
				}
			}
		}
		echo json_encode($data);
	}

	public function create() {
        $type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        $data = array();
		$data['type'] = $type;
		$data['title'] = 'Nuevo Cliente';
		$data['default'] = array(
            'id_visita' => '',
            'fecha' => '',
			'cod_vendedor' => '',
			'id_cliente' => '',
			'valor_neto' => '',
			'observaciones' => ''
		);
		$data['paises'] = $this->paises_model->get();
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Nuevo Cliente' => 'clientes/create');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
        if ($type === 'ajax') {
            $base_view = 'clientes/clientes_form';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
            $data['content'] = $this->load->view('clientes/clientes_form', $data, TRUE);
        }
		if ($this->_valid_form() === FALSE) {
			$this->load->view($base_view, $data);
		}
		else {
			$data = array(
                'FECHA' => $this->input->post('fecha'),
				'COD_VENDEDOR' => $this->input->post('cod_vendedor'),
				'ID_CLIENTE' => $this->input->post('id_cliente'),
				'VALOR_NETO' => $this->input->post('valor_neto'),
				'OBSERVACIONES' => $this->input->post('observaciones')
			);
			$rta = $this->clientes_model->insert($data);
			$this->_set_response('create', $rta, $type);
		}
	}

	public function view($id = FALSE) {
		$record = $this->_check_exists($id);
		$type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        $data = array();
		$data['type'] = $type;
		$data['title'] = 'Detalles Visita';
		$data['registro'] = $record;
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Detalles Visita' => 'clientes/view');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		if ($type === 'ajax') {
            $base_view = 'clientes/clientes_view';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
            $data['content'] = $this->load->view('clientes/clientes_view', $data, TRUE);
        }
		$this->load->view($base_view, $data);
	}

	public function edit($id = FALSE) {
		$record = $this->_check_exists($id);
        $type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        $data = array();
		$data['type'] = $type;
		$data['title'] = 'Editar Visita';
		$data['view'] = array('pages/menu', 'clientes/clientes_form');
		$data['default'] = array(
            'id_visita' => $record[0]['ID_VISITA'],
            'fecha' => $record[0]['FECHA'],
			'cod_vendedor' => $record[0]['COD_VENDEDOR'],
			'id_cliente' => $record[0]['ID_CLIENTE'],
			'valor_neto' => $record[0]['VALOR_NETO'],
			'observaciones' => $record[0]['OBSERVACIONES']
		);
		$data['vendedores'] = $this->vendedores_model->get();
		$data['clientes'] = $this->clientes_model->get();
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Editar Visita' => 'clientes/edit');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		if ($type === 'ajax') {
            $base_view = 'clientes/clientes_form';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
            $data['content'] = $this->load->view('clientes/clientes_form', $data, TRUE);
        }
		if ($this->_valid_form($record[0]) === FALSE) {
			$this->load->view($base_view, $data);
		}
		else {
			$data = array(
				'ID_VISITA' => $this->input->post('id_visita'),
                'FECHA' => $this->input->post('fecha'),
				'COD_VENDEDOR' => $this->input->post('cod_vendedor'),
				'ID_CLIENTE' => $this->input->post('id_cliente'),
				'VALOR_NETO' => $this->input->post('valor_neto'),
				'OBSERVACIONES' => $this->input->post('observaciones')
			);
			$rta = $this->clientes_model->update($data);
			$this->_set_response('edit', $rta, $type);
		}
	}

	public function delete($id = FALSE) {
		$record = $this->_check_exists($id);
        $type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        $data = array();
		$data['type'] = $type;
		$data['title'] = 'Borrar Visita';
		$data['id_visita'] = $record[0]['ID_VISITA'];
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Borrar Visita' => 'clientes/delete');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		if ($type === 'ajax') {
            $base_view = 'clientes/clientes_delete';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
            $data['content'] = $this->load->view('clientes/clientes_delete', $data, TRUE);
        }
		$this->form_validation->set_rules('id_visita', 'ID', 'trim|htmlspecialchars|required|integer');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view($base_view, $data);
		}
		else {
			$data = array(
				'ID_VISITA' => $this->input->post('id_visita')
			);
			$rta = $this->clientes_model->delete($data);
			$this->_set_response('delete', $rta, $type);
		}
	}

    private function _get_views(&$data) {
        $data['header'] = $this->load->view('layouts/header', NULL, TRUE);
		$data['footer'] = $this->load->view('layouts/footer', NULL, TRUE);
        $js['files'] = array(
            'datatable-style/js/jquery.dataTables.min.js',
            'datatable-style/js/dataTables.bootstrap4.min.js',
            'datatable-responsive/js/dataTables.responsive.min.js',
            'datatable-responsive/js/responsive.bootstrap4.min.js',
            'js/validate/jquery.validate.min.js',
            'js/validate/additional-methods.min.js',
            'js/php.default.min.js',
            'js/clientes.js'
        );
        $data['scripts'] = $this->load->view('layouts/scripts', $js, TRUE);
        $css['files'] = array(
            'datatable-style/css/dataTables.bootstrap4.min.css',
            'datatable-responsive/css/responsive.bootstrap4.min.css'
        );
        $data['styles'] = $this->load->view('layouts/styles', $css, TRUE);
    }

	private function _valid_form($record = FALSE) {
		$this->form_validation->set_rules('fecha', 'Fecha Visita', 'trim|htmlspecialchars|required|exact_length[10]');
		$this->form_validation->set_rules('valor_neto', 'Valor Neto', 'trim|htmlspecialchars|required|decimal|greater_than[0]');
		$this->form_validation->set_rules('cod_vendedor', 'Vendedor', 'trim|htmlspecialchars|required|integer');
		$this->form_validation->set_rules('id_cliente', 'Cliente', 'trim|htmlspecialchars|required|integer');
		return $this->form_validation->run();
	}

	private function _check_exists($id = FALSE) {
		$record = $this->clientes_model->get($id);
		if ($id === FALSE or count($record) === 0) {
			$this->session->set_flashdata('errors', $this->lang->line('no_single_data_found'));
			redirect(base_url('clientes'));
		}
		return $record;
	}

	private function _set_response($method = NULL, $rta = NULL, $type = NULL) {
		if (!is_null($method) && !is_null($rta) && !is_null($type)) {
			if ($rta === FALSE) {
				$this->session->set_flashdata('errors', $this->lang->line('data_' . $method . '_error'));
			}
			else {
				$this->session->set_flashdata('success', $this->lang->line('data_' . $method . '_success'));
			}
			if ($type === 'html') {
				redirect(base_url('clientes'));
			}
			else {
				echo 'RELOAD';
			}
		}
	}
}