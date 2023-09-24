<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report_image extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model("Report_image_model");
        $this->load->model("Role_model");

        // if ($this->session->userdata("login_data")['role_id'] == 2) {
        //     redirect("dashboard/agent_index");
        // }
    }

    function delete($report_image_id)
    {
        $dateFrom = date('Y-m-d');
        $dateTo = date('Y-m-d');
        $status = 0;
        $dealer_id = 0;
        if($this->session->userdata('report_dateFrom')) {
            $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : $this->session->userdata('report_dateFrom');
        }

        if($this->session->userdata('report_dateTo')) {
            $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : $this->session->userdata('report_dateTo');
        }

        if($this->session->userdata('report_status')) {
            $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : $this->session->userdata('report_status');
        }

        if ($this->session->userdata("login_data")['role_id'] != 2) {
            if($this->session->userdata('report_dealer_id')) {
                $dealer_id = ($_GET && isset($_GET['dealer_id'])) ? $_GET['dealer_id'] : $this->session->userdata('report_dealer_id');
            }
        }
        $this->Report_image_model->soft_delete($report_image_id);

        if ($this->session->userdata("login_data")['role_id'] != 2) {
            redirect("report?dateFrom=$dateFrom&dateTo=$dateTo&status=$status&dealer_id=$dealer_id", "refresh");
        } else {
            redirect("report?dateFrom=$dateFrom&dateTo=$dateTo&status=$status", "refresh");
        }
        
    }

}
