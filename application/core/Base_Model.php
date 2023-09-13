<?php

class Base_Model extends CI_Model
{
    /* --------------------------------------------------------------
     * VARIABLES
     * ------------------------------------------------------------ */

    /**
     * This model's default database table. Automatically
     * guessed by pluralising the model name.
     */
    protected $table_name;
    /**
     * This model's default primary key or unique identifier.
     * Used by the get(), update() and () functions.
     */
    protected $primary_key;
    /**
     * This model's default user updated ID. Default is zero
     */
    protected $user_id = 0;

    public function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->load->helper('inflector');
        $this->_fetch_table();
        $this->_fetch_table_primary_key();
    }

    /**
     * Guess the table name by the model name
     */
    private function _fetch_table()
    {
        if ($this->table_name == null) {
            $this->table_name = preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this)));
        }
    }

    /**
     * Guess the table name by the model name + '_id'
     */
    private function _fetch_table_primary_key()
    {
        if ($this->primary_key == null) {
            $this->primary_key = preg_replace('/(_m|_model)?$/', '', strtolower(get_class($this))) . '_id';
        }
    }

    function get_all_with_role()
    {
        $this->db->select("*, role.role AS role");
        $this->db->from($this->table_name);
        $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        $this->db->where("deleted", 0);
        $this->db->order_by($this->table_name . ".admin_id DESC");


        $query = $this->db->get();

        return $query->result_array();
    }

    function get_where($where)
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_where_with_role($where)
    {
        $this->db->select("*, role.role AS role");
        $this->db->from($this->table_name);
        $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        $this->db->where("deleted", 0);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result_array();
    }

    function get_where_and_primary_is_not($where, $primary_key)
    {
        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where($this->primary_key . "!=" . $primary_key);
        $this->db->where($where);

        $query = $this->db->get();

        return $query->result_array();
    }

    function insert($data)
    {
        $this->db->insert($this->table_name, $data);

        return $this->db->insert_id();
    }

    function update_where($where, $data)
    {
        $this->db->where($where);
        $this->db->update($this->table_name, $data);

        return $this->db->insert_id();
    }

    function soft_delete($primary_key)
    {
        $data = array(
            "deleted" => 1
        );

        $this->db->where($this->primary_key, $primary_key);
        $this->db->update($this->table_name, $data);
    }

    function hard_delete($primary_key)
    {
        $this->db->where($this->primary_key, $primary_key);
        $this->db->delete($this->table_name);
    }

    function soft_delete_where($where)
    {
        $data = array(
            "deleted" => 1
        );
        $this->db->where($where);
        $this->db->update($this->table_name, $data);
    }

    function hard_delete_where($where)
    {
        $this->db->where($where);
        $this->db->delete($this->table_name);
    }

    function login($username, $password)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("username = ", $username);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function login_otp($contact, $otp)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("contact = ", $contact);
        $this->db->where("otp = ", $otp);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        // $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function loginUserbyFacebook($facebook_id)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("facebook_id = ", $facebook_id);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        // $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function loginUserbyApple($user)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("apple_user = ", $user);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        // $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function loginUserBySocialEmail($googleId)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("google_id = ", $googleId);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        // $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function loginUser($username, $password)
    {

        $this->db->select("*");
        $this->db->from($this->table_name);
        $this->db->where("username = ", $username);
        // $this->db->join("role", $this->table_name . ".role_id = role.role_id", "left");
        $this->db->where("password = SHA2(CONCAT(salt,'" . $password . "'),512)");

        $query = $this->db->get();

        return $query->result_array();
    }

    function debug($data)
    {
        echo "<pre>";
        var_dump($data);
        echo "</pre>";
        die();
    }

    function get_all()
    {
        $fields = $this->db->list_fields($this->table_name);

        $deleted = false;
        foreach($fields as $row){
            if($row == "deleted"){
                $deleted = true;
            }
        }

        $this->db->select("*");
        $this->db->from($this->table_name);
        if($deleted){
            $this->db->where("deleted", 0);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_count($filter)
    {

        $temp_builder = $this->db;
        $temp_builder->select("(@no:=@no+1) AS no");
        if (!empty($filter)) {
            foreach ($filter as $key => $row) {
                if (strpos($key, 'sort') !== false) {
                    $order_by = explode("__", $row);
                    $temp_builder->order_by($order_by[0] . " " . $order_by[1]);
                } else {
                    $temp_builder->like($key, $row);
                }
            }
        }

        // die($this->builder->getCompiledSelect(false));

        $result = $temp_builder->get()->result_array(false);

        $this->sql = $this->db->last_query();

        return count($result);
    }

    public function set_running_no($index = 0)
    {
        $sql = "SET @no = " . $index;
        $this->db->query($sql);
    }

    public function get_paging($limit, $offset, $page, $pages, $filter)
    {

        $showing_from = $page - 2;
        $showing_to = $page + 2;

        $this->set_running_no($offset);

        $sql = $this->sql;
        $sql .= " LIMIT " . $limit . " OFFSET " . $offset;

        $result = $this->db->query($sql)->result_array();
        if ($pages == 0 or $pages == 1) {
            $pagination = "";
        } else {
            $pagination = '<nav aria-label="..." class="float-right">';
            $pagination .= '<ul class="pagination">';
            if ($page > 1) {
                $pagination .= '<li class="page-item">';
                $pagination .= '<span class="page-link" data-page="' . ($page - 1) . '">Previous</span>';
                $pagination .= '</li>';
            }
            if ($page == 1) {
                $pagination .= '<li class="page-item active"><a class="page-link" data-page="#">1</a></li>';
            } else {
                $pagination .= '<li class="page-item"><a class="page-link" data-page="1">1</a></li>';
            }
            if ($showing_from > 1) {
                $pagination .= '<li class="page-item" disabled><span class="page-link">...</span></li>';
            }
            $page_limit = 0;
            for ($i = ($page - 1); $i <= ($pages - 1); $i++) {
                if ($i > 1 and $i != $pages) {
                    if ($i == $page) {
                        $pagination .= '<li class="page-item active"><a class="page-link" data-page="#">' . $i . '</a></li>';
                    } else if ($i < $showing_to and $i > $showing_from) {
                        $pagination .= '<li class="page-item"><a class="page-link" data-page="' . $i . '">' . $i . '</a></li>';
                    }
                    $page_limit++;
                    if ($page_limit == 4) {
                        break;
                    }
                }
            }
            if ($showing_to < $pages) {
                $pagination .= '<li class="page-item" disabled><span class="page-link">...</span></li>';
            }
            if ($page == $pages) {
                $pagination .= '<li class="page-item active"><a class="page-link" data-page="#">' . $pages . '</a></li>';
            } else {
                $pagination .= '<li class="page-item"><a class="page-link" data-page="' . $pages . '">' . $pages . '</a></li>';
            }
            if ($page < $pages) {
                $pagination .= '<li class="page-item">';
                $pagination .= '<span class="page-link" data-page="' . ($page + 1) . '">Next</span>';
                $pagination .= '</li>';
            }
            $pagination .= '</ul>';
            $pagination .= '</nav>';
        }

        $data = array(
            "result" => $result,
            "pagination" => $pagination,
            "start_no" => 1 + $offset,
        );
        return $data;
        // $this->debug($sql);
    }
}
