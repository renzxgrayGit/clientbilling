<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charge extends CI_Model
{
    public function getCharges() 
    {
        $query = $this->db->query("SELECT month, year, total_cost FROM charges");
        return $query->result_array();
    }
}


