<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('visitas_model', 'visitas_model');
    }
    
    public function index() {
        $data['title'] = 'Visitas';
        $data['header'] = $this->load->view('layouts/header', NULL, TRUE);
        $migas['miga'] = array('Inicio' => '', 'Visitas' => 'visitas');
        $data['breadcrumb'] = $this->load->view('layouts/breadcrumb', $migas, TRUE);
        // $info['registros'] = $this->matriz_riesgo_model->get();
        $info['title'] = $data['title'];
        $data['content'] = $this->load->view('visitas', $info, TRUE);
		$data['footer'] = $this->load->view('layouts/footer', NULL, TRUE);
        $js['files'] = array(
            'datatable-style/js/jquery.dataTables.min.js',
            'datatable-style/js/dataTables.bootstrap4.min.js',
            'datatable-responsive/js/dataTables.responsive.min.js',
            'datatable-responsive/js/responsive.bootstrap4.min.js',
            'js/moment.min.js',
            'js/datetime-moment.js',
            'js/visitas.js'
        );
        $data['scripts'] = $this->load->view('layouts/scripts', $js, TRUE);
        $css['files'] = array(
            'datatable-style/css/dataTables.bootstrap4.min.css',
            'datatable-responsive/css/responsive.bootstrap4.min.css'
        );
        $data['styles'] = $this->load->view('layouts/styles', $css, TRUE);
		$data['success'] = $this->session->flashdata('success');
		$data['errors'] = $this->session->flashdata('errors');
		$this->load->view('layouts/app', $data);
    }
}