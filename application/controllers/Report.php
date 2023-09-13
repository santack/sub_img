<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Report extends Base_Controller
{

    function __construct()
    {
        parent::__construct();

        
        $this->load->model("Report_model");
        $this->load->model("Report_image_model");
        $this->load->model("Role_model");

        // if ($this->session->userdata("login_data")['role_id'] == 2) {
        //     redirect("dashboard/agent_index");
        // }
    }

    function index()
    {
        $report = $this->Report_model->get_all();
        if($report) {
            foreach($report as $key => $row) {
                $report_id = $row['report_id'];
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
        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/report/all");
        $this->load->view("admin/footer");
    }

    function detail($report_id)
    {

        $where = array(
            "report_id" => $report_id
        );

        $report = $this->Report_model->get_where_with_role($where);

        $this->show_404_if_empty($report);

        $this->page_data["report"] = $report[0];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/report/detail");
        $this->load->view("admin/footer");
    }

    function dd($data){
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
        die();
    }

    function add_image()
    {
        if($_POST) {
            $report_id = $_POST['report_id'];
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
                    'report_id' => $report_id
                );
                $data = array(
                    'is_uploaded' => 1
                );

                $this->Report_model->update_where($where, $data);
            }
        }
        redirect("report", "refresh");
    }

    function edit_image($report_id) {
        $images = array();
        if (isset($_FILES['files']['tmp_name'][0]) && $_FILES['files']['tmp_name'][0] != '') {
            $files = $_FILES['files'];
            // Loop through all the uploaded files
            for ($i = 0; $i < count($files['name']); $i++) {
                $file_name = $files['name'][$i];
                $file_tmp = $files['tmp_name'][$i];
        
                // Check if the file is an image
                if (getimagesize($file_tmp)) {
                    $upload_dir = 'public/image/';
                    $file_path = $upload_dir . $file_name;
        
                    // Move the file to the upload directory
                    if (move_uploaded_file($file_tmp, $file_path)) {
                        // Insert the file path into the database
                        $images[] = $file_name;
                    } else {
                        echo "Error uploading file $file_name.<br>";
                    }
                } else {
                    echo "File $file_name is not a valid image.<br>";
                }
            }
        }
    }

}
