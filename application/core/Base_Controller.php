<?php

class Base_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();

        $this->load->model("Admin_model");
        // $this->load->model("User_model");
        // $this->load->model("Orders_model");
        // $this->load->model("Role_access_model");

        if (!$this->session->has_userdata("login_data") and strtolower($this->uri->segment(1)) != "access" and strtolower($this->uri->segment(1)) != "main" and strtolower($this->uri->segment(1)) != "ajax" and strtolower($this->uri->segment(1)) != "") redirect("access/login", "refresh");

        $this->page_data = array();
    }

    function dd($variable){
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        die();
    }

    function hash($password)
    {
        $salt = rand(111111, 999999);
        $password = hash("sha512", $salt . $password);

        $hash = array(
            "salt" => $salt,
            "password" => $password,
        );

        return $hash;
    }

    function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }

    function check_exists($username, $exclude_id = "")
    {

        $where = array(
            "username" => $username
        );

        if ($exclude_id == "") {

            $admin = $this->Admin_model->get_where($where);
        } else if ($exclude_id != "") {
            $admin = $this->Admin_model->get_where_and_primary_is_not($where, $exclude_id);
        }

        if (empty($admin) AND empty($user)) {
            return false;
        } else {
            return true;
        }

    }

    function show_404_if_empty($array)
    {
        if (empty($array)) show_404();
    }

    public function upload_files($title, $files)
    {

        if (!empty($files['name'][0])) {

            $config = array(
                'upload_path'   => './public/image/',
                'allowed_types' => 'png|jpg|jpeg',
                'overwrite'     => 1,                       
            );
            

            $this->load->library('upload', $config);

            $images = array();

            foreach ($files['name'] as $key => $image) {
                $_FILES['images[]']['name']= $files['name'][$key];
                $_FILES['images[]']['type']= $files['type'][$key];
                $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images[]']['error']= $files['error'][$key];
                $_FILES['images[]']['size']= $files['size'][$key];

                $fileName = $title .'_'. $image;
                $image_path = "/public/image/" . str_replace(" ","_",$fileName);
                $data = [
                    'image_path' => $image_path,
                    'file_name' => $fileName,
                    'file_type' => $files['type'][$key]
                ];
                $images[] =$data;
               

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);
                

                // $this->debug($this->upload->data());
                if ($this->upload->do_upload('images[]')) {
                    $this->upload->data();
                } else {
                    $this->debug( $this->upload->display_errors());
                }
            }

            return $images;
        }else{
            return [];
        }
    }

    public function die_json($status , $data){
        if($status == TRUE){
            die(json_encode(array(
                'status' => $status,
                'data' => $data,
            ),JSON_PRETTY_PRINT));
        }else{
            die(json_encode(array(
                'status' => $status,
                'message' => $data,
            ),JSON_PRETTY_PRINT));
        }
    }

    function upload_image($image_name){
        
        if (!empty($_FILES[$image_name])) {

            $config = array(
                "allowed_types" => "png|jpg|jpeg",

                "upload_path" => "./public/image/",
                "path" => "/public/image/",
            );
            $this->load->library("upload", $config);

            if ($this->upload->do_upload($image_name)) {

                $banner = $config['path'] . $this->upload->data()['file_name'];
                return $banner;

            } else {
                $error = true;
                $error_msg = $this->upload->display_errors();
                $this->die_json(false,$error_msg);
                return "";
            }
        }
    }
    function upload_video($video_name){
        
        if (!empty($_FILES[$video_name])) {

            $config = array(
                "allowed_types" => "mp4",

                "upload_path" => "./public/image/",
                "path" => "/public/image/",
            );
            $this->load->library("upload", $config);

            if ($this->upload->do_upload($video_name)) {

                $banner = $config['path'] . $this->upload->data()['file_name'];
                return $banner;

            } else {
                $error = true;
                $error_msg = $this->upload->display_errors();
                $this->die_json(false,$error_msg);
                return "";
            }
        }
    }
    public function upload_videofiles($title, $files)
    {

        if (!empty($files['name'][0])) {

            $config = array(
                'upload_path'   => './public/image/',
                'allowed_types' => 'mp4',
                'overwrite'     => 1,                       
            );
            

            $this->load->library('upload', $config);

            $images = array();

            foreach ($files['name'] as $key => $image) {
                $_FILES['images[]']['name']= $files['name'][$key];
                $_FILES['images[]']['type']= $files['type'][$key];
                $_FILES['images[]']['tmp_name']= $files['tmp_name'][$key];
                $_FILES['images[]']['error']= $files['error'][$key];
                $_FILES['images[]']['size']= $files['size'][$key];

                $fileName = $title .'_'. $image;
                $image_path = "/public/image/" . str_replace(" ","_",$fileName);
                $data = [
                    'image_path' => $image_path,
                    'file_name' => $fileName,
                    'file_type' => $files['type'][$key]
                ];
                $images[] =$data;
               

                $config['file_name'] = $fileName;

                $this->upload->initialize($config);
                

                // $this->debug($this->upload->data());
                if ($this->upload->do_upload('images[]')) {
                    $this->upload->data();
                } else {
                    $this->debug( $this->upload->display_errors());
                }
            }

            return $images;
        }else{
            return [];
        }
    }


    function multi_image_upload($files, $field_name, $path)
    {
        $urls = array();
        $error = false;

        if(is_array($files[$field_name]['name'])){
            $files_count = count($files[$field_name]['name']);

            for ($i = 0; $i < $files_count; $i++) {

                $_FILES["image"]['name'] = $files[$field_name]['name'][$i];
                $_FILES["image"]['type'] = $files[$field_name]['type'][$i];
                $_FILES["image"]['tmp_name'] = $files[$field_name]['tmp_name'][$i];
                $_FILES["image"]['error'] = $files[$field_name]['error'][$i];
                $_FILES["image"]['size'] = $files[$field_name]['size'][$i];
    
                $config = array(
                    "allowed_types" => "gif|png|jpg|jpeg",
                    "upload_path" => "./images/" . $path . "/",
                    "path" => "/images/" . $path . "/"
                );
    
                $this->load->library("upload", $config);
    
                if ($this->upload->do_upload("image")) {
                    $url = $config['path'] . $this->upload->data()['file_name'];
    
                    array_push($urls, $url);
                } else {
                    $error = true;
                    $error_message = $this->upload->display_errors();
                    $data = array(
                        "error" => true,
                        "message" => $error_message
                    );
    
                    return $data;
                }
            }
        } else {
            $config = array(
                "allowed_types" => "gif|png|jpg|jpeg",
                "upload_path" => "./images/" . $path . "/",
                "path" => "/images/" . $path . "/"
            );

            $this->load->library("upload", $config);

            if ($this->upload->do_upload($field_name)) {

                $url = $config['path'] . $this->upload->data()['file_name'];
    
                array_push($urls, $url);

            } else {
                $error = true;
                $error_message = $this->upload->display_errors();
                $data = array(
                    "error" => true,
                    "message" => $error_message
                );

                return $data;
            }
        }

        return $urls;
    }
}

?>
