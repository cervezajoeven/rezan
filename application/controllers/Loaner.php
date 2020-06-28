<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loaner extends CI_Controller {

	public $model;
	public $controller;
	public $data;
	public $table;
	
	function __construct(){
		parent::__construct();
		$this->model = $this->loaner_model;
		$this->controller = "loaner";
		$this->table = "loaner";
		$this->navigation = array("manage","loaners");
	}

	public function index()
	{
		$this->data['data'] = $this->model->all();
		$this->data['breadcrumb'] = "Loaners List";
		$this->load->view('parts/header',$this->data);
		$this->load->view($this->controller."/".__FUNCTION__,$this->data);
		
	}

	public function edit($id)
	{
		$this->data['data'] = $this->model->get($id);
		$this->data['breadcrumb'] = "Edit Loaner";
		$this->load->view('parts/header',$this->data);
		$this->load->view($this->controller."/".__FUNCTION__,$this->data);
	}

	public function save()
	{
		$data['name'] = $_REQUEST['name'];
		
		$this->model->save($data);

		redirect(base_url($this->controller));
	}

	public function edit_save()
	{
		$data['id'] = $_REQUEST['id'];
		$data['name'] = $_REQUEST['name'];
		
		$this->model->update($data);

		redirect(base_url($this->controller));
	}

	public function delete($id)
	{

		$this->model->delete($id);

		redirect(base_url($this->controller));
	}
}
