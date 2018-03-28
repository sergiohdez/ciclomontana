<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('clientes_model', 'clientes_model');
        $this->load->model('ciudades_model', 'ciudades_model');
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
			$this->_decode_nit($data['data']);
		}
		echo json_encode($data);
	}

	public function create() {
        $type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        $data = array();
		$data['type'] = $type;
		$data['title'] = 'Nuevo Cliente';
		$data['default'] = array(
            'id_cliente' => '',
            'nit' => '',
			'nombre' => '',
			'direccion' => '',
			'telefono' => '',
			'cod_ciudad' => '',
			'cod_departamento' => '',
			'cod_pais' => '',
			'cupo' => '',
			'saldo_cupo' => '',
			'porcentaje_visitas' => ''
		);
		$data['paises'] = $this->paises_model->get();
		$data['departamentos'] = array();
		$data['ciudades'] = array();
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
                'NIT' => $this->encryption->encrypt($this->input->post('nit')),
				'NOMBRE' => $this->input->post('nombre'),
				'DIRECCION' => $this->input->post('direccion'),
				'TELEFONO' => $this->input->post('telefono'),
				'COD_CIUDAD' => $this->input->post('cod_ciudad'),
				'CUPO' => $this->input->post('cupo'),
				'SALDO_CUPO' => $this->input->post('cupo'),
				'PORCENTAJE_VISITAS' => $this->input->post('porcentaje_visitas')
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
		$data['title'] = 'Detalles Cliente';
		$this->_decode_nit($record);
		$data['registro'] = $record;
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Detalles Cliente' => 'clientes/view');
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
		$data['title'] = 'Editar Cliente';
		$this->_decode_nit($record);
		$data['default'] = array(
            'id_cliente' => $record[0]['ID_CLIENTE'],
            'nit' => $record[0]['NIT'],
			'nombre' => $record[0]['NOMBRE'],
			'direccion' => $record[0]['DIRECCION'],
			'telefono' => $record[0]['TELEFONO'],
			'cod_ciudad' => $record[0]['COD_CIUDAD'],
			'cod_departamento' => $record[0]['COD_DEPARTAMENTO'],
			'cod_pais' => $record[0]['COD_PAIS'],
			'cupo' => $record[0]['CUPO'],
			'saldo_cupo' => $record[0]['SALDO_CUPO'],
			'porcentaje_visitas' => $record[0]['PORCENTAJE_VISITAS']
		);
		$data['paises'] = $this->paises_model->get();
		$data['departamentos'] = $this->departamentos_model->get($record[0]['COD_PAIS']);
		$data['ciudades'] = $this->ciudades_model->get($record[0]['COD_DEPARTAMENTO']);
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Editar Cliente' => 'clientes/edit');
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
				'ID_CLIENTE' => $this->input->post('id_cliente'),
                'NIT' => $this->encryption->encrypt($this->input->post('nit')),
				'NOMBRE' => $this->input->post('nombre'),
				'DIRECCION' => $this->input->post('direccion'),
				'TELEFONO' => $this->input->post('telefono'),
				'COD_CIUDAD' => $this->input->post('cod_ciudad'),
				'CUPO' => $this->input->post('cupo'),
				// 'SALDO_CUPO' => $this->input->post('cupo'), // No se permite
				'PORCENTAJE_VISITAS' => $this->input->post('porcentaje_visitas')
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
		$data['title'] = 'Borrar Cliente';
		$data['id_cliente'] = $record[0]['ID_CLIENTE'];
        $migas['miga'] = array('Inicio' => '', 'Clientes' => 'clientes', 'Borrar Cliente' => 'clientes/delete');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		if ($type === 'ajax') {
            $base_view = 'clientes/clientes_delete';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
            $data['content'] = $this->load->view('clientes/clientes_delete', $data, TRUE);
        }
		$this->form_validation->set_rules('id_cliente', 'ID', 'trim|htmlspecialchars|required|integer');
		if ($this->form_validation->run() === FALSE) {
			$this->load->view($base_view, $data);
		}
		else {
			$data = array(
				'ID_CLIENTE' => $this->input->post('id_cliente')
			);
			$rta = $this->clientes_model->delete($data);
			$this->_set_response('delete', $rta, $type);
		}
	}

	public function options_combo($type = FALSE, $id = FALSE) {
		$options = array();
		if ($id !== FALSE) {
			switch($type) {
				case 'departamento':
					$options = $this->departamentos_model->get($id);
					break;
				case 'ciudad':
					$options = $this->ciudades_model->get($id);
					break;
			}
		}
		echo json_encode($options);
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
		$this->form_validation->set_rules('nit', 'NIT', 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('direccion', 'Direcci&oacute;n', 'trim|htmlspecialchars|required');
		$this->form_validation->set_rules('telefono', 'Tel&eacute;fono', 'trim|htmlspecialchars|required|numeric|greater_than[0]');
		$this->form_validation->set_rules('cod_ciudad', 'Ciudad', 'trim|htmlspecialchars|required|integer');
		$this->form_validation->set_rules('cupo', 'Cupo', 'trim|htmlspecialchars|required|decimal|greater_than[0]');
		$this->form_validation->set_rules('porcentaje_visitas', 'Porcentaje Visitas', 'trim|htmlspecialchars|required|integer|greater_than[0]|less_than_equal_to[100]');
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

	private function _decode_nit(&$data) {
		foreach ($data as $k => $e) {
			if (isset($e['NIT'])) {
				$data[$k]['NIT'] = $this->encryption->decrypt($e['NIT']);
			}
		}
	}
}