<?php

class Api_error_model extends Base_model{
    
    function __construct(){
        parent::__construct();
        
        $this->table_name = "api_error";
    }
     
}