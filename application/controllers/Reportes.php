<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('reportes_model', 'reportes_model');
        $this->load->model('clientes_model', 'clientes_model');
    }

    public function index() {
        $data = array();
        $data['title'] = 'Reportes';
        $this->_get_views($data);
		$data['success'] = $this->session->flashdata('success');
        $data['errors'] = $this->session->flashdata('errors');
        $data['visitas_ciudad'] = $this->reportes_model->getVisitasCiudad();
        $data['cupos_cliente'] = array();
        $data['clientes'] = $this->clientes_model->get();
        $data['content'] = $this->load->view('reportes/reportes_home', $data, TRUE);
        $migas['miga'] = array('Inicio' => '', 'Reportes' => 'reportes');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
		$this->load->view('layouts/app', $data);
    }

    private function _get_views(&$data) {
        $data['header'] = $this->load->view('layouts/header', NULL, TRUE);
		$data['footer'] = $this->load->view('layouts/footer', NULL, TRUE);
        $js['files'] = array(
            'js/php.default.min.js',
            'js/Chart.min.js',
            'js/reportes.js'
        );
        $data['scripts'] = $this->load->view('layouts/scripts', $js, TRUE);
        $css['files'] = array(
            'datatable-style/css/dataTables.bootstrap4.min.css',
            'datatable-responsive/css/responsive.bootstrap4.min.css'
        );
        $data['styles'] = $this->load->view('layouts/styles', $css, TRUE);
    }

    public function cupos_cliente($id = FALSE) {
        $data = $this->reportes_model->getCuposCliente($id);
        echo json_encode($data);
    }

}