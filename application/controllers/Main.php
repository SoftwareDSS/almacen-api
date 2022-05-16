<?php
// Required Classes
require_once APPPATH . '/controllers/Response.php';
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends Response {

	public function index() {

        $apiInformation = array(

            "version"   => "1.0",
            "author"    => "Antonio G. antonioglez1801@gmail.com",
            "framework" => "Code Igniter 3"

        );

		$this->send( $apiInformation, 200, 'Success' );

	}

}
