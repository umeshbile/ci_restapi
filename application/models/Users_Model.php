<?php defined('BASEPATH') OR exit('No direct script access allowed');
class Users_Model extends CI_Model{

    public function __construct(){
        parent::__construct();
        $this->table = 'user';
    }

    public function getusers(){
        $query = $this->db->get($this->table);
        return !empty($query->result_array())?$query->result_array() : false;
    }
}