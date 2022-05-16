<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Main controller
$route[ 'default_controller' ][ 'GET' ] = 'categoriesController/getAll';
//Products
$route[ 'products/all' ]    = 'productsController/getAll';
$route[ 'products/:id' ]    = '';
$route[ 'products/create' ] = 'productsController/save';
$route[ 'products/delete' ] = '';
//Categories
$route[ 'categories/all' ][ 'GET' ]                               = 'categoriesController/getAll';
$route[ 'categories/category/(:any)' ][ 'GET' ]                   = 'categoriesController/getOne/$1';
$route[ 'categories/category/(:any)/attributes' ][ 'GET' ]        = 'categoriesController/getAttributesByCategory/$1';
$route[ 'categories/category/attributes/(:any)/values' ][ 'GET' ] = 'categoriesController/getAttributeValuesByAttributeCategoryId/$1';
$route[ 'categories/category/(:any)/attributes/values' ][ 'GET' ] = 'categoriesController/getAttributeValuesByCategoryId/$1';
//Atributes

$route['404_override']         = '';
$route['translate_uri_dashes'] = FALSE;
