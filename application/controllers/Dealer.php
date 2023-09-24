<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Dealer extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        
        $this->load->model("Admin_model");
        $this->load->model("Role_model");

        if ($this->session->userdata("login_data")['role_id'] == 2) {
            redirect("customer");
        }

        $this->page_data['type'] = 'dealer';
    }

    function index()
    {
        $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : date('Y-m-d');
        $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : date('Y-m-d');
        $type = ($_GET && isset($_GET['type'])) ? $_GET['type'] : 1;

        if($this->session->userdata('dealer_dateFrom')) {
            $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : $this->session->userdata('dealer_dateFrom');
        }

        if($this->session->userdata('dealer_dateTo')) {
            $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : $this->session->userdata('dealer_dateTo');
        }

        if($this->session->userdata('dealer_type')) {
            $type = ($_GET && isset($_GET['type'])) ? $_GET['type'] : $this->session->userdata('dealer_type');
        }

        $this->session->set_userdata("dealer_dateFrom", $dateFrom);
        $this->session->set_userdata("dealer_dateTo", $dateTo);
        $this->session->set_userdata("dealer_type", $type);

        $where = array(
            'admin.role_id' => 2,
            'DATE(admin.created_date) >=' => $dateFrom,
            'DATE(admin.created_date) <=' => $dateTo,
            'admin.is_active' => $type
        );
        $this->page_data["admin"] = $this->Admin_model->get_where_with_role($where);
        $this->page_data["dateFrom"] = $dateFrom;
        $this->page_data["dateTo"] = $dateTo;
        $this->page_data["type"] = $type;
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/dealer/all");
        $this->load->view("admin/footer");
    }

    function add()
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            $exists = $this->check_exists($input["username"]);

            if ($exists) {
                $error = true;
                $this->page_data["error"] = "Username already exists.";
                $this->page_data["input"] = $input;
            }
            if ($input["password"] != $input["password2"]) {
                $error = true;
                $this->page_data["error"] = "Passwords do not match";
                $this->page_data["input"] = $input;
            }

            if (!$error) {
                $hash = $this->hash($input['password']);

                $data = array(
                    'username' => $input['username'],
                    'role_id' => 2,
                    'code_id' => $input['code_id'],
                    'name' => $input['name'],
                    'contact' => $input['contact'],
                    'area' => $input['area'],
                    'password' => $hash['password'],
                    'salt' => $hash['salt'],
                    'created_by' => $this->session->userdata('login_id')
                );

                $this->Admin_model->insert($data);

                // die($this->db->last_query());

                redirect("dealer", "refresh");
            }
        }
        $this->page_data['type'] = 'dealer';
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/dealer/add");
        $this->load->view("admin/footer");
    }

    function detail($admin_id)
    {

        $where = array(
            "admin_id" => $admin_id
        );

        $admin = $this->Admin_model->get_where_with_role($where);

        $this->show_404_if_empty($admin);

        $this->page_data["admin"] = $admin[0];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/dealer/detail");
        $this->load->view("admin/footer");
    }

    function edit($admin_id)
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            $exists = $this->check_exists($input["username"], $admin_id);

            if ($exists) {
                $error = true;
                $this->page_data["error"] = "Username already exists.";
                $this->page_data["input"] = $input;
            }
            if (!empty($input['password'])) {
                if ($input["password"] != $input["password2"]) {
                    $error = true;
                    $this->page_data["error"] = "Passwords do not match";
                    $this->page_data["input"] = $input;
                }
            }

            if (!$error) {
                $where = array(
                    'admin_id' => $admin_id
                );

                $data = array(
                    'username' => $input['username'],
                    'name' => $input['name'],
                    'code_id' => $input['code_id'],
                    'contact' => $input['contact'],
                    'area' => $input['area'],
                    "modified_date" => date("Y-m-d H:i:s"),
                    'modified_by' => $this->session->userdata('login_id')
                );

                if (!empty($input['password'])) {
                    $hash = $this->hash($input['password']);
                    $data['password'] = $hash['password'];
                    $data['salt'] = $hash['salt'];
                }

                $this->Admin_model->update_where($where, $data);

                // redirect('dealer/detail/' . $admin_id, "refresh");
                redirect('dealer' , "refresh");
            }
        }

        $where = array(
            "admin_id" => $admin_id
        );

        $admin = $this->Admin_model->get_where($where);

        $this->show_404_if_empty($admin);

        $this->page_data["admin"] = $admin[0];
        // $this->page_data['type'] = 'dealer';
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/dealer/edit");
        $this->load->view("admin/footer");
    }

    function delete($admin_id)
    {
        $this->Admin_model->soft_delete($admin_id);

        redirect("dealer", "refresh");
    }

}
