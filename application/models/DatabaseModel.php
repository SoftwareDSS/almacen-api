<?php
class DatabaseModel extends CI_Model {

    public function __construct() {

        parent::__construct();
        $this->load->database();

    }

    public function executeQuery( $query ) {

        $databaseResponse = $this->db->query( $query );

        return $databaseResponse->result_array();

    }

    public function executeInsertQuery( $query ) {

        return $this->db->query( $query );

    }

}