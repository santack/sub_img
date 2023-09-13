<?php

class Api_request_model extends Base_model{
    
    function __construct(){
        parent::__construct();
        
        $this->table_name = "api_request";
    }
     
}