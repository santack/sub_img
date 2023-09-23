<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Package extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        
        $this->load->model("Package_model");
        $this->load->model("Role_model");

        if ($this->session->userdata("login_data")['role_id'] == 2) {
            redirect("dashboard/agent_index");
        }
    }

    function index()
    {
        $this->page_data["package"] = $this->Package_model->get_all();
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/package/all");
        $this->load->view("admin/footer");
    }

    function add()
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            if (!$error) {

                $data = array(
                    'name' => $input['name'],
                    'created_by' => $this->session->userdata('login_id')
                );

                $this->Package_model->insert($data);

                // die($this->db->last_query());

                redirect("package", "refresh");
            }
        }

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/package/add");
        $this->load->view("admin/footer");
    }

    function detail($package_id)
    {

        $where = array(
            "package_id" => $package_id
        );

        $package = $this->Package_model->get_where($where);

        $this->show_404_if_empty($package);

        $this->page_data["package"] = $package[0];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/package/detail");
        $this->load->view("admin/footer");
    }

    function edit($package_id)
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            if (!$error) {
                $where = array(
                    'package_id' => $package_id
                );

                $data = array(
                    'name' => $input['name'],
                    "modified_date" => date("Y-m-d H:i:s"),
                    'modified_by' => $this->session->userdata('login_id')
                );

                $this->Package_model->update_where($where, $data);

                // redirect('package/detail/' . $package_id, "refresh");
                redirect('package' , "refresh");
            }
        }

        $where = array(
            "package_id" => $package_id
        );

        $package = $this->Package_model->get_where($where);

        $this->show_404_if_empty($package);

        $this->page_data["package"] = $package[0];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/package/edit");
        $this->load->view("admin/footer");
    }

    function delete($package_id)
    {
        $this->Package_model->soft_delete($package_id);

        redirect("package", "refresh");
    }

}
