<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Charge extends CI_Model
{
    public function getCharges($start_date = null, $end_date = null) 
    {
        // Modify the SQL query to include date range filtering
        $sql = "SELECT month, year, total_cost FROM charges";

        // Add WHERE clause for filtering based on start and end dates
        if ($start_date && $end_date) 
        {
            // Add conditions to filter charges within the specified date range
            $sql .= " WHERE STR_TO_DATE(CONCAT(year, '-', month, '-01'), '%Y-%M-%d') BETWEEN ? AND ?";
            
            // Execute the SQL query with parameters for start and end dates
            $query = $this->db->query($sql, array($start_date, $end_date));
        } 
        else 
        {
            // Execute the SQL query without filtering if start or end date is not provided
            $query = $this->db->query($sql);
        }
        var_dump($sql);

        // Return the result array
        return $query->result_array();
    }
}


