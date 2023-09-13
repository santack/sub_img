<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Role_access extends Base_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model("Role_access_model");
        $this->load->model("Module_model");
        $this->load->model("Role_model");

            }

    public function index()
    {
        $role_id = ($_GET and $_GET['role_id']) ? $_GET['role_id'] : 1;

        $page = 1;
        $filter = array();

        if($_GET){
            $get = $this->input->get();

            if (!empty($get['page'])) {
                $page = $get['page'];
            }
            if (!empty($get['role_id'])) {
                $get['role_access.role_id'] = $get['role_id'];
            }
            unset($get['page']);
            unset($get['role_id']);
            $filter = $get;
        }

        $where = array(
            'role_access.role_id' => $role_id,
        );
        $access = $this->Role_access_model->get_where($where, 10, $page, $filter);

        $this->page_data['role'] = $this->Role_model->get_all();
        $this->page_data['role_id'] = $role_id;
        $this->page_data['page_id'] = $page;

        $this->page_data['access'] = $access['result'];
        $this->page_data['page'] = $access['pagination'];
        $this->page_data['start_no'] = $access['start_no'];

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/role_access/all");
        $this->load->view("admin/footer");
    }

    public function unset_active($role_access_id, $action, $page){

        $where = array(
            'role_access_id' => $role_access_id,
        );
        $data[$action] = 0;
        $this->Role_access_model->update_where($where, $data);
        $role_id = $this->Role_access_model->get_where($where)[0]['role_id'];

        redirect('role_access?role_id=' . $role_id . '&page=' . $page, 'refresh');
    }

    public function set_active($role_access_id, $action, $page){

        $where = array(
            'role_access_id' => $role_access_id,
        );
        $data[$action] = 1;
        $this->Role_access_model->update_where($where, $data);
        $role_id = $this->Role_access_model->get_where($where)[0]['role_id'];

        redirect('role_access?role_id=' . $role_id . '&page=' . $page, 'refresh');
    }

    public function add()
    {

        if ($_POST) {

            $input = $this->input->post();
            $error = false;

            $where = array(
                'role_access.role_id' => $input['role_id'],
                'role_access.module_id' => $input['module_id'],
            );
            $existed = $this->Role_access_model->get_where($where);

            if(!empty($existed)){
                $error = true;
                $this->page_data['error'] = 'Already Existed';
            }

            if(!$error){

                $data = array(
                    'module_id' => $input['module_id'],
                    'role_id' => $input['role_id'],
                );
                $this->Role_access_model->insert($data);

                redirect('role_access', "refresh");
            }
        }

        $role = $this->Role_model->get_all();
        $module = $this->Module_model->get_all();

        $this->page_data['role'] = $role;
        $this->page_data['module'] = $module;

        $this->load->view("admin/header", $this->page_data);
        $this->load->view("admin/role_access/add");
        $this->load->view("admin/footer");
    }

    // public function edit($role_id)
    // {

    //     $where = array(
    //         "role_access.role_id" => $role_id,
    //     );

    //     $role_access = $this->Role_access_model->get_where($where);
    //     if ($_POST) {
    //         $input = $this->input->post();

    //         foreach ($role_access as $row) {
    //             $where = array(
    //                 "role_access_id" => $row['role_access_id'],
    //             );

    //             $data = array(
    //                 "r_access" => 0,
    //                 "c_access" => 0,
    //                 "u_access" => 0,
    //                 "d_access" => 0,
    //             );

    //             if(!empty($input[$row['role_access_id'] . "_r_access"])){
    //                 $data['r_access'] = $input[$row['role_access_id'] . "_r_access"];
    //             }
    //             if(!empty($input[$row['role_access_id'] . "_c_access"])){
    //                 $data['c_access'] = $input[$row['role_access_id'] . "_c_access"];
    //             }
    //             if(!empty($input[$row['role_access_id'] . "_u_access"])){
    //                 $data['u_access'] = $input[$row['role_access_id'] . "_u_access"];
    //             }
    //             if(!empty($input[$row['role_access_id'] . "_d_access"])){
    //                 $data['d_access'] = $input[$row['role_access_id'] . "_d_access"];
    //             }

    //             $this->Role_access_model->update_where($where, $data);
    //         }

    //         redirect('role_access/edit/' . $role_id, "refresh");
    //     }

    //     if (empty($role_access)) {
    //         $this->generate_role_access();
    //         redirect('role_access/edit/' . $role_id, "refresh");
    //     }
    //     $this->page_data['role_access'] = $role_access;

    //     $this->load->view("admin/header", $this->page_data);
    //     $this->load->view("admin/role_access/edit");
    //     $this->load->view("admin/footer");
    // }

    // public function generate_role_access()
    // {
    //     $this->generate_modules();
    //     $modules = $this->Module_model->get_all();
    //     $roles = $this->Role_model->get_all();

    //     foreach ($modules as $m_row) {
    //         foreach ($roles as $r_key => $r_row) {
    //             $where = array(
    //                 "role_access.role_id" => $r_row['role_id'],
    //                 "role_access.module_id" => $m_row['module_id'],
    //             );

    //             $role_access = $this->Role_access_model->get_where($where);
    //             if (empty($role_access)) {
    //                 if ($r_key == 0) {
    //                     $data = array(
    //                         "role_id" => $r_row['role_id'],
    //                         "module_id" => $m_row['module_id'],
    //                         "c_access" => 1,
    //                         "r_access" => 1,
    //                         "u_access" => 1,
    //                         "d_access" => 1,
    //                     );
    //                 } else {
    //                     $data = array(
    //                         "role_id" => $r_row['role_id'],
    //                         "module_id" => $m_row['module_id'],
    //                         "c_access" => 0,
    //                         "r_access" => 1,
    //                         "u_access" => 0,
    //                         "d_access" => 0,
    //                     );
    //                 }

    //                 $this->Role_access_model->insert($data);
    //             }
    //         }
    //     }
    // }
}
