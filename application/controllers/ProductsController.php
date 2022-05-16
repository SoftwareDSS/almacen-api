<?php
// Required Classes
require_once APPPATH . '/controllers/Response.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductsController extends Response {

    public function __construct() {

        parent::__construct();

        $this->load->model( 'ProductsModel', 'products' );

    }

	public function getAll() {

        try {
            
            $databaseResponse = $this->products->getAll();
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

	}

    public function save() {

        try {
            
            $_POST       = json_decode( file_get_contents( "php://input" ), true ); 
            $productInput = $this->input->post();
    
            $this->products->save( $productInput );
            $this->send( null, 202, 'Created' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

    }

}
