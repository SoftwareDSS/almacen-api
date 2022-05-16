<?php
// Required Classes
require_once APPPATH . '/controllers/Response.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoriesController extends Response {

    public function __construct() {

        parent::__construct();

        $this->load->model( 'CategoriesModel', 'categories' );

    }

	public function getAll() {

        try {
            
            $databaseResponse = $this->categories->getAll();
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

	}

	public function getOne( $id ) {

        try {
            
            $databaseResponse = $this->categories->getOne( $id );
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

	}

    public function getAttributesByCategory( $id ) {

        try {
            
            $databaseResponse = $this->categories->getAttributesByCategory( $id );
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

    }

    public function getAttributeValuesByAttributeCategoryId( $id ) {

        try {
            
            $databaseResponse = $this->categories->getAttributeValuesByAttributeCategoryId( $id );
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }

    }

    public function getAttributeValuesByCategoryId( $id ) {

        try {
            
            $databaseResponse = $this->categories->getAttributeValuesByCategoryId( $id );
            $this->send( $databaseResponse, 200, 'Ok' );

        } 
        catch ( Exception $e ) {

            $this->sendError();

        }        

    }

}
