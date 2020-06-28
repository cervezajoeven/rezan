<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Collection extends CI_Controller {

	public $model;
	public $controller;
	public $data;
	public $table;
	public $navigation;
	function __construct(){
		parent::__construct();
		$this->model = $this->collection_model;
		$this->controller = "collection";
		$this->table = "collection";
		$this->navigation = array("transactions","collection");
	}

	public function index($current_date="")
	{
		if($current_date==""){
			$selected_date = date("Y-m-d");
		}else{
			$selected_date = $current_date;
		}

		$this->data['data'] = $this->collection_model->collection_today($selected_date);
		$this->data['borrowers'] = $this->borrower_model->all();
		$this->data['loans'] = $this->loan_model->all();
		$this->data['total_collection_today'] = $this->collection_model->total_collection_today($selected_date);
		$this->data['total_payers_today'] = $this->collection_model->total_payers_today($selected_date);
		$this->data['selected_date'] = $selected_date;
		
		// echo "<pre>";
		// print_r($this->data['loans']);
		// exit();
		$this->load->view('parts/header');
		$this->load->view($this->controller."/".__FUNCTION__,$this->data);
		
	}

	public function save($selected_date="")
	{

		$data['loan_id'] = $_REQUEST['loan_id'];
		$data['amount'] = $_REQUEST['amount'];
		$data['date'] = $_REQUEST['date'];
		$data['date_created'] = date("Y-m-d H:i:s");
		
		$this->model->save($data);
		if($selected_date==""){
			redirect(base_url($this->controller));
		}else{
			redirect(base_url($this->controller."/index/".$selected_date));
		}
		
	}

	public function edit($id,$current_date="")
	{

		if($current_date==""){
			$selected_date = date("Y-m-d");
		}else{
			$selected_date = $current_date;
		}

		$this->data['data'] = $this->collection_model->collection_today($selected_date);
		$this->data['borrowers'] = $this->borrower_model->all();
		$this->data['loans'] = $this->loan_model->all();
		$this->data['total_collection_today'] = $this->collection_model->total_collection_today($selected_date);
		$this->data['total_payers_today'] = $this->collection_model->total_payers_today($selected_date);
		$this->data['collection'] = $this->collection_model->get($id);
		$this->data['selected_date'] = $selected_date;
		// echo "<pre>";
		// print_r($this->data['collection']);
		// exit();
		$this->load->view('parts/header');
		$this->load->view($this->controller."/".__FUNCTION__,$this->data);
		
	}

	public function edit_save($id,$selected_date="")
	{
		$data['id'] = $id;
		$data['loan_id'] = $_REQUEST['loan_id'];
		$data['amount'] = $_REQUEST['amount'];
		$data['date'] = $_REQUEST['date'];
		$data['date_updated'] = date("Y-m-d H:i:s");
		$this->model->update($data);

		if($selected_date==""){
			redirect(base_url($this->controller));
		}else{
			redirect(base_url($this->controller."/index/".$selected_date));
		}
	}

	public function delete($id,$selected_date="")
	{

		var_dump($this->model->delete($id));
		
		if($selected_date==""){
			redirect(base_url($this->controller));
		}else{
			redirect(base_url($this->controller."/index/".$selected_date));
		}
	}
}
