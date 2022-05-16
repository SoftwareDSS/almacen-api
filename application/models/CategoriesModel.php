<?php
// Required Classes
require_once APPPATH . '/models/DatabaseModel.php';
class CategoriesModel extends DatabaseModel {

    public function __construct(){

        parent::__construct();

    }

    public function getAll() {

        $query = "SELECT * FROM categorias";

        return $this->executeQuery( $query );

    }

    public function getOne( $idCategory ) {

        $query = "SELECT * FROM categorias WHERE id = '$idCategory'";

        return $this->executeQuery( $query );

    }

    public function getAttributesByCategory( $idCategory ) {

        $query = "SELECT * FROM atributos_categoria WHERE id_categoria = '$idCategory'";

        return $this->executeQuery( $query );

    }

    public function getAttributeValuesByAttributeCategoryId( $atributeId ) {

        $query = "SELECT * FROM atributos_categoria_valores WHERE id_atributo_categoria = '$atributeId'";

        return $this->executeQuery( $query );

    }

    public function getAttributeValuesByCategoryId( $id ) {

        $formatResponse = array();

        $query = 
            "
            SELECT

                att_cate_val.id as id,
                category_attributes.attribute_name,
                att_cate_val.valor as valor
            FROM
            ( 
            SELECT 
                cate.id as category_id, 
                cate.nombre as category_name,
                att_cate.nombre as attribute_name,
                att_cate.id as attribute_id
            FROM 
                categorias as cate
            LEFT JOIN 
                atributos_categoria as att_cate
            ON
                cate.id = att_cate.id_categoria
            WHERE 
                cate.id = '$id' 
            ) as category_attributes
            LEFT JOIN 
                atributos_categoria_valores as att_cate_val
            ON
                att_cate_val.id_atributo_categoria = category_attributes.attribute_id
        ";

        $queryResponse = $this->executeQuery( $query );

        for( $i = 0; $i < count( $queryResponse ); $i++ ) {

            $attribute_id   = $queryResponse[ $i ][ 'id' ];
            $attribute_name = $queryResponse[ $i ][ 'attribute_name' ];
            $valor          = $queryResponse[ $i ][ 'valor' ];

            if( isset( $formatResponse[ $attribute_name ] )){
                
                array_push( $formatResponse[ $attribute_name ], array(
                    "id"    => $attribute_id,
                    "valor" => $valor
                ));

            }
            else{

                $formatResponse[ $attribute_name ] = array();

                array_push( $formatResponse[ $attribute_name ], array(
                    "id"    => $attribute_id,
                    "valor" => $valor
                ));

            }

        }

        return $formatResponse;

    }

}