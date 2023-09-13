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
        $this->Report_image_model->soft_delete($report_image_id);

        redirect("report", "refresh");
    }

}
