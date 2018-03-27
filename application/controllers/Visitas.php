<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('visitas_model', 'visitas_model');
        //$this->load->model('vendedores_model', 'vendedores_model');
        //$this->load->model('clientes_model', 'clientes_model');
    }
    
    public function index() {
        $data = array();
        $data['title'] = 'Visitas';
        $info['title'] = $data['title'];
        $this->_get_views($data);
        $js['files'] = array(
            'datatable-style/js/jquery.dataTables.min.js',
            'datatable-style/js/dataTables.bootstrap4.min.js',
            'datatable-responsive/js/dataTables.responsive.min.js',
            'datatable-responsive/js/responsive.bootstrap4.min.js',
            'js/moment.min.js',
            'js/datetime-moment.js',
            'js/validate/jquery.validate.min.js',
            'js/validate/additional-methods.min.js',
            'js/php.default.min.js',
            'js/bootstrap-datepicker.js',
            'js/bootstrap-datepicker.es.min.js',
            'js/visitas.js'
        );
        $data['scripts'] = $this->load->view('layouts/scripts', $js, TRUE);
        $css['files'] = array(
            'datatable-style/css/dataTables.bootstrap4.min.css',
            'datatable-responsive/css/responsive.bootstrap4.min.css',
            'css/datepicker3.css'
        );
        $data['styles'] = $this->load->view('layouts/styles', $css, TRUE);
        $data['content'] = $this->load->view('visitas/visitas_home', $info, TRUE);
		$this->load->view('layouts/app', $data);
    }

	public function data() {
		$data = $this->visitas_model->get_dt();
		echo json_encode($data);
	}

	public function create() {
        $type = is_null($this->input->get('type')) ? 'html' : $this->input->get('type');
        if ($type === 'ajax') {
            $base_view = 'visitas/visitas_form';
        }
        else {
            $base_view = 'layouts/app';
            $this->_get_views($data);
        }
        $js['files'] = array(
            'js/moment.min.js',
            'js/datetime-moment.js',
            'js/validate/jquery.validate.min.js',
            'js/validate/additional-methods.min.js',
            'js/php.default.min.js',
            'js/bootstrap-datepicker.js',
            'js/bootstrap-datepicker.es.min.js',
            'js/visitas.js'
        );
        $data['scripts'] = $this->load->view('layouts/scripts', $js, TRUE);
        $css['files'] = array(
            'css/datepicker3.css'
        );
        $data['styles'] = $this->load->view('layouts/styles', $css, TRUE);
		$data['type'] = $type;
		$data['title'] = 'Nueva Visita';
		$data['default'] = array(
            'id_visita' => '',
            'fecha' => '',
			'cod_vendedor' => '',
			'id_cliente' => '',
			'valor_neto' => '',
			'observaciones' => ''
		);
		$data['vendedores'] = array(); //$this->vendedores_model->get();
		$data['clientes'] = array(); //$this->clientes_model->get();
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
			$rta = $this->visitas_model->insert($data);
			$this->_set_response('create', $rta, $type);
		}
	}

    private function _get_views(&$data) {
        $data['header'] = $this->load->view('layouts/header', NULL, TRUE);
        $migas['miga'] = array('Inicio' => '', 'Visitas' => 'visitas');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		$data['footer'] = $this->load->view('layouts/footer', NULL, TRUE);
		$data['success'] = $this->session->flashdata('success');
		$data['errors'] = $this->session->flashdata('errors');
    }

	private function _valid_form($record = FALSE) {
		$this->form_validation->set_rules('fecha', 'Fecha Visita', 'trim|htmlspecialchars|required|exact_length[10]');
		$this->form_validation->set_rules('valor_neto', 'Valor Neto', 'trim|htmlspecialchars|required|decimal|greater_than[0]');
		$this->form_validation->set_rules('cod_vendedor', 'Vendedor', 'trim|htmlspecialchars|required|integer');
		$this->form_validation->set_rules('id_cliente', 'Cliente', 'trim|htmlspecialchars|required|integer');
		return $this->form_validation->run();
	}

	private function _check_exists($id = FALSE) {
		$record = $this->visitas_model->get($id);
		if ($id === FALSE or count($record) === 0) {
			$this->session->set_flashdata('errors', $this->lang->line('no_single_data_found'));
			redirect(base_url('visitas'));
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
				redirect(base_url('visitas'));
			}
			else {
				echo 'RELOAD';
			}
		}
	}
}