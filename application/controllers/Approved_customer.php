<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approved_customer extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->page_data = array();

        $this->load->model("User_model");
        $this->load->model("Report_image_model");

        if ($this->session->userdata("login_data")['role_id'] == 2) {
            redirect("customer");
        }
    }

    function index()
    {
        $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : 1;

        if($this->session->userdata('approval_cust_status')) {
            $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : $this->session->userdata('approval_cust_status');
        }
        
        $where = '';
        

        $customer = $this->db->query("
                SELECT user.*, package.name as package_name, admin.username as dealer_name
        FROM user
        LEFT JOIN package ON user.package_id = package.package_id
        LEFT JOIN admin ON user.dealer_id = admin.admin_id
        WHERE user.is_active = $status AND user.user_status = 1 $where
        ")->result_array();

        if($customer) {
            foreach($customer as $key => $row) {
                $user_status = $row['user_status'];
                if($user_status == 0) {
                    $customer[$key]['status'] = 'Pending';
                } else if($user_status == 1) {
                    $customer[$key]['status'] = 'Approved';
                } else if($user_status == 2) {
                    $customer[$key]['status'] = 'Rejected';
                } else {
                    $customer[$key]['status'] = 'Renew';
                }
            }
        }

        $this->session->set_userdata("approval_cust_status", $status);

        // $customer = $this->User_model->get_all();
        $this->page_data["customer"] = $customer;
        $this->page_data["status"] = $status;
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/approval_customer/all");
        $this->load->view("admin/footer");
    }

    function edit($user_id) {
        $status = 1;
        if($this->session->userdata('approval_cust_status')) {
            $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : $this->session->userdata('approval_cust_status');
        }

        if($_POST) {
            $where = array(
                'user_id' => $user_id
            );
            if(isset($_POST['created_date'])) {
                $data = array(
                    'created_date' => $_POST['created_date']
                );
            } else if(isset($_POST['end_date'])) {
                $data = array(
                    'end_date' => $_POST['end_date']
                );
            } else if(isset($_POST['expired_date'])) {
                $data = array(
                    'expired_date' => $_POST['expired_date']
                );
            }
            //approved_customer?status=0
            $this->User_model->update_where($where, $data);
            redirect('approved_customer?status='.$status, 'refresh');
        }
    }

    function renew($user_id) {
        $where = array(
            'user_id' => $user_id
        );

        $data = array(
            'user_status' => 3,
            'is_image_uploaded' => 0,
            'created_date' => date('Y-m-d H:i:s')
        );

        $this->User_model->update_where($where, $data);

        $where_image = array(
            'report_id' => $user_id
        );

        $data_image = array(
            'deleted' => 1
        );
        $this->Report_image_model->update_where($where_image, $data_image);

        $status = 1;
        if($this->session->userdata('approval_cust_status')) {
            $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : $this->session->userdata('approval_cust_status');
        }

        redirect('approved_customer?status='.$status, 'refresh');
    }
}