<?php


defined('BASEPATH') or exit('No direct script access allowed');

class Api extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->page_data = array();
        // header('Access-Control-Allow-Origin: *');
        // header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");

        // $this->instant_delivery_fee = 20;
        $this->load->model('Bank_model');
        $this->load->model('Api_error_model');
        $this->load->model('Api_request_model');


        date_default_timezone_set('Asia/Kuala_Lumpur');

        if ($_REQUEST) {
            $data = [
                'params' => json_encode($_REQUEST),
                'action' => basename($_SERVER['REQUEST_URI']),
            ];
            $this->Api_request_model->insert($data);
        }



        if ($_POST and !empty($_POST['fcm_token']) and !empty($_POST['user_token'])) {
            // die(json_encode(array(
            //     "status" => false,
            //     "message" => $_POST['fcm_token']
            // )));
            $this->save_fcm_token($_POST['user_token'], $_POST['fcm_token']);
        }

        if ($_POST and !empty($_POST['fcm_token']) and !empty($_POST['userToken'])) {
            // die(json_encode(array(
            //     "status" => false,
            //     "message" => $_POST['fcm_token']
            // )));
            $this->save_fcm_token($_POST['userToken'], $_POST['fcm_token']);
        }

        if ($_POST and !empty($_POST['fcm_token']) and !empty($_POST['token'])) {

            $this->save_fcm_token($_POST['token'], $_POST['fcm_token']);
        }
    }

    function hash($password)
    {
        $salt = rand(111111, 999999);
        $password = hash('sha512', $salt . $password);

        $hash = [
            'salt' => $salt,
            'password' => $password,
        ];

        return $hash;
    }


    public function save_fcm_token($user_token, $fcm_token)
    {
        $where = array(
            "token" => $user_token,
        );
        $data = array(
            "fcm_token" => $fcm_token,
        );

        $this->User_model->update_where($where, $data);
    }

    function check_exists($username, $exclude_id = '')
    {
        $where = [
            'username' => $username,
        ];

        if ($exclude_id == '') {
            $admin = $this->Admin_model->get_where($where);
            $user = $this->User_model->get_where($where);
        } elseif ($exclude_id != '') {
            // $admin = $this->Admin_model->get_where_and_primary_is_not($where, $exclude_id);
            $user = $this->User_model->get_where_and_primary_is_not(
                $where,
                $exclude_id
            );
        }

        if (empty($admin) and empty($user)) {
            return false;
        } else {
            return true;
        }
    }

    function check_exists_email($email, $exclude_id = '')
    {
        $where = [
            'email' => $email,
        ];

        if ($exclude_id == '') {
            $admin = $this->Admin_model->get_where($where);
            $user = $this->User_model->get_where($where);
        } elseif ($exclude_id != '') {
            // $admin = $this->Admin_model->get_where_and_primary_is_not($where, $exclude_id);
            $user = $this->User_model->get_where_and_primary_is_not(
                $where,
                $exclude_id
            );
        }

        if (empty($admin) and empty($user)) {
            return false;
        } else {
            return true;
        }
    }

    function startsWith($string, $startString)
    {
        $len = strlen($startString);
        return substr($string, 0, $len) === $startString;
    }

    function dd($variable){
        echo '<pre>';
        var_dump($variable);
        echo '</pre>';
        die();
    }

    function get_bank() {
        $sql = "SELECT * FROM bank";
        $bank = $this->db->query($sql)->result_array();
        $data = array();
        if(!empty($bank)) {
            $data = $bank[0];
        }

        die(json_encode([
            'status' => true,
            'data' => $data,
        ]));
    }
}
