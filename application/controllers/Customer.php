<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->page_data = array();

        $this->load->model("User_model");
    }

    function index()
    {
        $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : date('Y-m-d');
        $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : date('Y-m-d');
        $type = ($_GET && isset($_GET['type'])) ? $_GET['type'] : 1;

        if($this->session->userdata('customer_dateFrom')) {
            $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : $this->session->userdata('customer_dateFrom');
        }

        if($this->session->userdata('customer_dateTo')) {
            $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : $this->session->userdata('customer_dateTo');
        }

        if($this->session->userdata('customer_type')) {
            $type = ($_GET && isset($_GET['type'])) ? $_GET['type'] : $this->session->userdata('customer_type');
        }
        
        $where = '';
        if ($this->session->userdata("login_data")['role_id'] == 2) {
            $dealer_id = $this->session->userdata('login_id');
            $where = array(
                'DATE(user.created_date) >=' => $dateFrom,
                'DATE(user.created_date) <=' => $dateTo,
                'user.is_active' => $type,
                'user.dealer_id' => $dealer_id
            );
            $where = ' AND user.dealer_id = ' .$dealer_id;
        }
        

        $customer = $this->db->query("
                SELECT user.*, package.name as package_name
        FROM user
        LEFT JOIN package ON user.package_id = package.package_id
        WHERE DATE(user.created_date) >= '$dateFrom' AND DATE(user.created_date) <= '$dateTo' AND user.is_active = $type $where
        ")->result_array();

        $this->session->set_userdata("customer_dateFrom", $dateFrom);
        $this->session->set_userdata("customer_dateTo", $dateTo);
        $this->session->set_userdata("customer_type", $type);

        // $customer = $this->User_model->get_all();
        $this->page_data["customer"] = $customer;
        $this->page_data["dateFrom"] = $dateFrom;
        $this->page_data["dateTo"] = $dateTo;
        $this->page_data["type"] = $type;
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/customer/all");
        $this->load->view("admin/footer");
    }

    function add()
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;
            if ($this->session->userdata("login_data")['role_id'] == 2) {
                $dealer_id = $this->session->userdata('login_id');
            } else {
                $dealer_id = $input['dealer_id'];
            }

            if (!$error) {
                $data = array(
                    'dealer_id'          => $dealer_id,
                    'company_name'          => $input['company_name'],
                    'company_ssm_no'          => $input['company_ssm_no'],
                    'contact'       => $input['contact'],
                    'address'      => $input['address'],
                    'email'      => $input['email'],
                    'url'      => $input['url'],
                    'package_id'      => $input['package_id'],
                    'type'      => $input['type'],
                    'created_by'    => $this->session->userdata('login_id')
                    
                );
                
                $this->User_model->insert($data);

                redirect("customer", "refresh");
            }
        }

        $cust_sql = "SELECT * FROM user WHERE is_active = 1 AND deleted = 0";
        $this->page_data['user'] = $this->db->query($cust_sql)->result_array();
        $this->page_data['package'] = $this->getPackage();
        $this->page_data['dealer'] = $this->getDealer();
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/customer/add");
        $this->load->view("admin/footer");
    }

    function getPackage()
    {
        $sql = "SELECT * FROM package WHERE deleted = 0";
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    function getDealer(){
        $sql = "SELECT * FROM admin WHERE role_id = 2 AND is_active = 1 AND deleted = 0";
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    function detail($user_id)
    {

        $customer = $this->db->query("
                SELECT user.*, package.name as package_name
        FROM user
        LEFT JOIN package ON user.package_id = package.package_id AND package.deleted = 0
        WHERE user.user_id = $user_id
        ")->result_array();

        $this->show_404_if_empty($customer);

        $this->page_data["customer"] = $customer[0];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/customer/detail");
        $this->load->view("admin/footer");
    }


    function edit($user_id)
    {

        if ($_POST) {
            $input = $this->input->post();

            $error = false;

            if ($this->session->userdata("login_data")['role_id'] == 2) {
                $dealer_id = $this->session->userdata('login_id');
            } else {
                $dealer_id = $input['dealer_id'];
            }

            if (!$error) {
                $where = array(
                    'user_id' => $user_id
                );

                $data = array(
                    'dealer_id'          => $dealer_id,
                    'company_name'          => $input['company_name'],
                    'company_ssm_no'          => $input['company_ssm_no'],
                    'contact'       => $input['contact'],
                    'address'      => $input['address'],
                    'email'      => $input['email'],
                    'url'      => $input['url'],
                    'package_id'      => $input['package_id'],
                    'type'      => $input['type'],
                    "modified_date" => date("Y-m-d H:i:s"),
                    'modified_by' => $this->session->userdata('login_id')
                );

                $this->User_model->update_where($where, $data);

                redirect('customer' , "refresh");
            }
        }

        $where = array(
            "user_id" => $user_id
        );

        $customer = $this->User_model->get_where($where);

        $this->show_404_if_empty($customer);

        $this->page_data["customer"] = $customer[0];
        $this->page_data['package'] = $this->getPackage();
        $this->page_data['dealer'] = $this->getDealer();
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/customer/edit");
        $this->load->view("admin/footer");
    }

    function delete($user_id)
    {
        $this->User_model->soft_delete($user_id);

        redirect("customer", "refresh");
    }

    function get_customer_detail()
    {
        if($_POST) {
            $user_id = isset($_POST['user_id']) ? $_POST['user_id'] : 0;
            $user = array();
            if($user_id != 0) {
                $sql = "SELECT * FROM user WHERE user_id = $user_id";
                $user = $this->db->query($sql)->result_array();

                if($user) {
                    $user = $user[0];
                }
            }
            echo json_encode($user);
        }
    }
}