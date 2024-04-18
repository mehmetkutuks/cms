<?php
class Product extends CI_Controller
{
	public $viewFolder = "";

	public function __construct()
	{
		parent::__construct();
		$this->viewFolder = "product_v";
		$this->load->model("product_model");
	}

	public function index()
	{
		//tablodan verilerin getirilmesi
		$items = $this->product_model->get_all();
		

		$viewData = new stdClass();
		$viewData->viewFolder = $this->viewFolder;
		$viewData->subViewFolder = "list";
		$viewData->items = $items;

		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}

    public function new_form()
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "add";
		$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
	}


	public function save()
	{
		$this->load->library("form_validation");
		//kurallar yazilir
		$this->form_validation->set_rules("title", "Product name", "required|trim");
		$this->form_validation->set_message(
			array(
				"required" => "<b>{field}</b> must be filled."
			)
		);
		//form validation calistirilir
		$validate = $this->form_validation->run();
		
		if($validate)
		{
			$insert = $this->product_model->add(
				array(
					"title" 		=> $this->input->post("title"),
					"description" 	=> $this->input->post("description"),
					"url" 			=> convertToSeo($this->input->post("title")),
					"rank"			=> 0,
					"isActive" 		=> 1,
					"createdAt" 	=> date("Y-m-d H:i:s")
				)
			);

			if($insert)
			{
                redirect(base_url("product"));
			} else {
                redirect(base_url("product"));
			}
		}
		else {
			$viewData = new stdClass();
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "add";
			$viewData->form_error = true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}
	}
}
