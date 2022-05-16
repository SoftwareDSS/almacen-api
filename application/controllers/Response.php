<?php
defined('BASEPATH') OR exit( 'No direct script access allowed' );

/* 
    * Class Api
*/
class Response extends CI_Controller {
    
    protected $serverResponse = array( 

        'status'  => '200', 
        'data'    => null, 
        'message' => 'Ok' 

    );

    public function __construct() {

        header( 'Access-Control-Allow-Origin: *' );
        header("Access-Control-Allow-Headers: Content-Type, Content-Length, Accept-Encoding");
        header( "Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE" );
        parent::__construct();

    }

    protected function send( $data = null, $status = 200, $message = "Ok" ) {
        
        $this->serverResponse[ 'status' ]  = $status;
        $this->serverResponse[ 'data' ]    = $data;
        $this->serverResponse[ 'message' ] = $message;

		$this->output
        ->set_header( "HTTP/1.0 $status OK" )
        ->set_content_type( 'application/json' )
        ->set_output( json_encode( $this->serverResponse ));

    }

    protected function sendError() {

        $this->serverResponse[ 'status' ]  = 500;
        $this->serverResponse[ 'data' ]    = null;
        $this->serverResponse[ 'message' ] = "Server error.";

		$this->output
        ->set_header( "HTTP/1.0 500 OK" )
        ->set_content_type( 'application/json' )
        ->set_output( json_encode( $this->serverResponse ));

    }

    protected function notFound() {

        $this->serverResponse[ 'status' ]  = 500;
        $this->serverResponse[ 'data' ]    = null;
        $this->serverResponse[ 'message' ] = "Server error.";

		$this->output
        ->set_header( "HTTP/1.0 404 OK" )
        ->set_content_type( 'application/json' )
        ->set_output( json_encode( $this->serverResponse ));

    }

}