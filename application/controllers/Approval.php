<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Approval extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->page_data = array();

        $this->load->model("User_model");

        if ($this->session->userdata("login_data")['role_id'] == 2) {
            redirect("customer");
        }
    }

    function index()
    {
        $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : date('Y-m-d');
        $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : date('Y-m-d');
        $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : 0;

        if($this->session->userdata('approval_dateFrom')) {
            $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : $this->session->userdata('approval_dateFrom');
        }

        if($this->session->userdata('approval_dateTo')) {
            $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : $this->session->userdata('approval_dateTo');
        }

        if($this->session->userdata('approval_status')) {
            $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : $this->session->userdata('approval_status');
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
                SELECT user.*, package.name as package_name, admin.username as dealer_name
        FROM user
        LEFT JOIN package ON user.package_id = package.package_id
        LEFT JOIN admin ON user.dealer_id = admin.admin_id
        WHERE DATE(user.created_date) >= '$dateFrom' AND DATE(user.created_date) <= '$dateTo' AND user.is_active = 1 AND user.user_status = $status $where
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

        $this->session->set_userdata("approval_dateFrom", $dateFrom);
        $this->session->set_userdata("approval_dateTo", $dateTo);
        $this->session->set_userdata("approval_status", $status);

        // $customer = $this->User_model->get_all();
        $this->page_data["customer"] = $customer;
        $this->page_data["dateFrom"] = $dateFrom;
        $this->page_data["dateTo"] = $dateTo;
        $this->page_data["status"] = $status;
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/approval/all");
        $this->load->view("admin/footer");
    }

    function approve($user_id) {
        $where = array(
            'user.user_id' => $user_id
        );

        $data = array(
            'user_status' => 1,
            'created_date' => date("Y-m-d H:i:s"),
            'end_date' => date('Y-m-d', strtotime('+1 year')),
            'expired_date' => date('Y-m-d', strtotime('+30 days'))
        );

        $this->User_model->update_where($where, $data);
        redirect('approval', 'refresh');
    }

    function reject($user_id) {
        $where = array(
            'user.user_id' => $user_id
        );

        $data = array(
            'user_status' => 2,
            'rejected_date' => date("Y-m-d H:i:s"),
        );

        $this->User_model->update_where($where, $data);
        redirect('approval', 'refresh');
    }
}