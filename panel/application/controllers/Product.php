<?php
class Product extends CI_Controller
{
	public $viewFolder = "";

	public function __construct()
	{
		parent::__construct();
		$this->viewFolder = "product_v";
		$this->load->model("product_model");
        $this->load->model("product_image_model");
	}

	public function index()
	{
		//tablodan verilerin getirilmesi
		$items = $this->product_model->get_all(
            array(), "rank ASC"
        );
		

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
            //todo alert
			if($insert)
			{
                $alert = array(
                    "title" => "Transaction Successful",
                    "text"  => "The record has been added successfully.",
                    "type"  => "success"
                );
			} else {
                $alert = array(
                    "title" => "Transaction Failed",
                    "text"  => "The record could not be added, please try again later.",
                    "type"  => "error"
                );
			}
            //İşlemin sonucunu sessiona yazma işlemi
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("product"));
		}
		else {
			$viewData = new stdClass();
			$viewData->viewFolder = $this->viewFolder;
			$viewData->subViewFolder = "add";
			$viewData->form_error = true;
			$this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
		}
	}

    public function update_form($id)
    {
        $viewData = new stdClass();
        /** tablodan verilerin getirilmesi **/

        $item = $this->product_model->get(
            array(
                "id" => $id
            )
        );
        /*view'e gönderilecek değerlerin set edilmesi*/
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "update";
        $viewData->item = $item;

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function update($id)
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
            $update = $this->product_model->update(
                array(
                    "id"            => $id
                ),
                array(
                    "title" 		=> $this->input->post("title"),
                    "description" 	=> $this->input->post("description"),
                    "url" 			=> convertToSeo($this->input->post("title"))
                )
            );

            if($update)
            {
                $alert = array(
                    "title" => "Transaction Successful",
                    "text"  => "The record has been updated successfully.",
                    "type"  => "success"
                );
            } else {
                $alert = array(
                    "title" => "Transaction Failed",
                    "text"  => "The record could not be updated, please try again later.",
                    "type"  => "error"
                );
            }
            //İşlemin sonucunu sessiona yazma işlemi
            $this->session->set_flashdata("alert", $alert);
            redirect(base_url("product"));
        }
        else {
            $viewData = new stdClass();

            /* tablodan verilerin getirilmesi */
            $item = $this->product_model->get(
                array(
                    "id" => $id
                )
            );

            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "update";
            $viewData->form_error = true;
            $viewData->item = $item;


            $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
        }
    }

    public function delete($id)
    {
        $delete = $this->product_model->delete(
            array(
                "id" => $id
            )
        );

        if($delete)
        {
            $alert = array(
                "title" => "Transaction Successful",
                "text"  => "The record has been deleted successfully.",
                "type"  => "success"
            );
        } else {
            $alert = array(
                "title" => "Transaction Failed",
                "text"  => "The record could not be deleted, please try again later.",
                "type"  => "error"
            );
        }
        //İşlemin sonucunu sessiona yazma işlemi
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("product"));
    }

    public function isActiveSetter($id)
    {
        if ($id)
        {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }

    public function imageIsActiveSetter($id)
    {
        if ($id)
        {
            $isActive = ($this->input->post("data") === "true") ? 1 : 0;

            $this->product_image_model->update(
                array(
                    "id" => $id
                ),
                array(
                    "isActive" => $isActive
                )
            );
        }
    }

    public function isCoverSetter($id, $parent_id)
    {
        if ($id && $parent_id)
        {
            $isCover = ($this->input->post("data") === "true") ? 1 : 0;

            //kapak yapılmak istenen id
            $this->product_image_model->update(
                array(
                    "id"         => $id,
                    "product_id" => $parent_id
                ),
                array(
                    "isCover" => $isCover
                )
            );

            //kapak yapılmak istenmeyen diğer kayıtlar
            $this->product_image_model->update(
                array(
                    "id !="         => $id,
                    "product_id"    => $parent_id
                ),
                array(
                    "isCover" => 0
                )
            );

            $viewData = new stdClass();
            $viewData->viewFolder = $this->viewFolder;
            $viewData->subViewFolder = "image";

            $viewData->item_images = $this->product_image_model->get_all(
                array(
                    "product_id" => $parent_id
                ),
                "rank ASC"
            );

            $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
            echo $render_html;
        }
    }

    public function rankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id)
        {
            $this->product_model->update(
                array(
                    "id"      => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank"    => $rank
                )
            );
        }
    }
    public function imageRankSetter()
    {
        $data = $this->input->post("data");
        parse_str($data, $order);
        $items = $order['ord'];

        foreach ($items as $rank => $id)
        {
            $this->product_image_model->update(
                array(
                    "id"      => $id,
                    "rank !=" => $rank
                ),
                array(
                    "rank"    => $rank
                )
            );
        }
    }

    public function image_form($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item = $this->product_model->get(
            array(
                "id" => $id
            )
        );

        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id" => $id
            ),
            "rank ASC"
        );

        $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/index", $viewData);
    }

    public function image_upload($id)
    {
        $file_name = convertToSeo(pathinfo($_FILES["file"]["name"], PATHINFO_FILENAME)) . "." . pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION);
        $config["allowed_types"] = "jpeg|jpg|png";
        $config["upload_path"]   = "upload/$this->viewFolder/";
        $config["file_name"] = $file_name;

        $this->load->library("upload", $config);

        $upload = $this->upload->do_upload("file");

        if ($upload)
        {
            $uploaded_file = $this->upload->data("file_name");
            $this->product_image_model->add(
                array(
                    "img_url"    => $uploaded_file,
                    "rank"       => 0,
                    "isActive"   => 1,
                    "isCover"    => 0,
                    "createdAt"  => date("Y-m-d H:i:s"),
                    "product_id" => $id
                )
            );
        } else {
            $alert = array(
                "title" => "Transaction Failed",
                "text"  => "The image could not be added, please try again later.",
                "type"  => "error"
            );
        }


        //İşlemin sonucunu sessiona yazma işlemi
        $this->session->set_flashdata("alert", $alert);
    }

    public function refresh_image_list($id)
    {
        $viewData = new stdClass();
        $viewData->viewFolder = $this->viewFolder;
        $viewData->subViewFolder = "image";

        $viewData->item_images = $this->product_image_model->get_all(
            array(
                "product_id" => $id
            ),
            "rank ASC"
        );

        $render_html = $this->load->view("{$viewData->viewFolder}/{$viewData->subViewFolder}/render_elements/image_list_v", $viewData, true);
        echo $render_html;
    }

    public function imageDelete($id, $parent_id)
    {
        $fileName = getFileName($id);

        $delete = $this->product_image_model->delete(
            array(
                "id" => $id
            )
        );


        if($delete)
        {
            unlink("upload/{$this->viewFolder}/$fileName->img_url");
            $alert = array(
                "title" => "Transaction Successful",
                "text"  => "The image has been deleted successfully.",
                "type"  => "success"
            );
        } else {
            $alert = array(
                "title" => "Transaction Failed",
                "text"  => "The image could not be deleted, please try again later.",
                "type"  => "error"
            );
        }
        //İşlemin sonucunu sessiona yazma işlemi
        $this->session->set_flashdata("alert", $alert);
        redirect(base_url("product/image_form/$parent_id"));
    }


}
