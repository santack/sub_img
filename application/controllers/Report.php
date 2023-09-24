<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        
        $this->load->model("User_model");
        $this->load->model("Report_image_model");
        $this->load->model("Role_model");

        // if ($this->session->userdata("login_data")['role_id'] == 2) {
        //     redirect("dashboard/agent_index");
        // }
    }

    function index()
    {
        $dateFrom = ($_GET && isset($_GET['dateFrom']) && $_GET['dateFrom']) ? $_GET['dateFrom'] : date('Y-m-d');
        $dateTo = ($_GET && isset($_GET['dateTo']) && $_GET['dateTo']) ? $_GET['dateTo'] : date('Y-m-d');
        $status = ($_GET && isset($_GET['status'])) ? $_GET['status'] : 0;
        $dealer_id = 0;
        if ($this->session->userdata("login_data")['role_id'] != 2) {
            $dealer_id = ($_GET && isset($_GET['dealer_id'])) ? $_GET['dealer_id'] : 0;
        }

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
        
        $where = ' AND user.dealer_id = ' .$dealer_id;
        if ($this->session->userdata("login_data")['role_id'] == 2) {
            $dealer_id = $this->session->userdata('login_id');
            $where = array(
                'DATE(user.created_date) >=' => $dateFrom,
                'DATE(user.created_date) <=' => $dateTo,
                'user.is_active' => 1,
                'user.dealer_id' => $dealer_id
            );
            $where = ' AND user.dealer_id = ' .$dealer_id;
        }
        
        $report = $this->db->query("
                SELECT user.*, package.name as package_name
        FROM user
        LEFT JOIN package ON user.package_id = package.package_id
        WHERE DATE(user.created_date) >= '$dateFrom' AND DATE(user.created_date) <= '$dateTo' AND user.is_active = 1 AND user.is_image_uploaded = $status $where
        ")->result_array();

        // $report = $this->Report_model->get_all();
        if($report) {
            foreach($report as $key => $row) {
                $report_id = $row['user_id'];
                $sql = "SELECT *, CONCAT('" . base_url(). "', report_image.image) as image_true FROM report_image WHERE report_image.is_active = 1 AND report_image.deleted = 0 AND report_image.report_id = $report_id";
                $images = $this->db->query($sql)->result_array();
                if($images) {
                    $report[$key]['images'] = $images;
                } else {
                    $report[$key]['images'] = array();
                }
            }
        }
        // $this->dd($report);
        $this->page_data["report"] = $report;
        $this->session->set_userdata("report_dateFrom", $dateFrom);
        $this->session->set_userdata("report_dateTo", $dateTo);
        $this->session->set_userdata("report_status", $status);

        if ($this->session->userdata("login_data")['role_id'] != 2) {
            $this->session->set_userdata("report_dealer_id", $dealer_id);
        }

        $this->page_data["dateFrom"] = $dateFrom;
        $this->page_data["dealer"] = $this->getDealer();
        $this->page_data["dateTo"] = $dateTo;
        $this->page_data["status"] = $status;
        $this->page_data["dealer_id"] = $dealer_id;
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/report/all");
        $this->load->view("admin/footer");
    }

    function getDealer(){
        $sql = "SELECT * FROM admin WHERE role_id = 2 AND is_active = 1 AND deleted = 0";
        $result = $this->db->query($sql)->result_array();

        return $result;
    }

    function add_image()
    {
        if($_POST) {
            $report_id = $_POST['user_id'];
            $images = array();
            if (isset($_FILES['files']['name'])) {
                $files = $_FILES['files'];
            
                // Loop through all the uploaded files
                for ($i = 0; $i < count($files['name']); $i++) {
                    $file_name = $files['name'][$i];
                    $file_tmp = $files['tmp_name'][$i];
                    // $this->dd($file_tmp);
                    // Check if the file is an image
                    if (getimagesize($file_tmp)) {
                        $upload_dir = 'public/image/';
                        $file_path = $upload_dir . $file_name;
            
                        // Move the file to the upload directory
                        if (move_uploaded_file($file_tmp, $file_path)) {
                            // Insert the file path into the database
                            $images[] = $file_path;
                        } else {
                            echo "Error uploading file $file_name.<br>";
                        }
                    } else {
                        echo "File $file_name is not a valid image.<br>";
                    }
                }
            }
            if($images) {
                foreach($images as $row) {
                    $data = array(
                        'report_id' => $report_id,
                        'image' => $row
                    );

                    $this->Report_image_model->insert($data);
                }

                // update report
                $where = array(
                    'user_id' => $report_id
                );
                $data = array(
                    'is_image_uploaded' => 1
                );

                $this->User_model->update_where($where, $data);
            }
        }

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
        // redirect("report", "refresh");
        if ($this->session->userdata("login_data")['role_id'] != 2) {
            redirect("report?dateFrom=$dateFrom&dateTo=$dateTo&status=$status&dealer_id=$dealer_id", "refresh");
        } else {
            redirect("report?dateFrom=$dateFrom&dateTo=$dateTo&status=$status", "refresh");
        }
    }

}
