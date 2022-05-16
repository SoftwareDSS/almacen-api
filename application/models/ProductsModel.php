<?php
// Required Classes
require_once APPPATH . '/models/DatabaseModel.php';
class ProductsModel extends DatabaseModel {

    public function __construct(){

        parent::__construct();

    }

    public function getAll() {

        $query    = 
        "
        SELECT
            prod.id,
            prod.nombre,
            prod.marca,
            prod.sku,
            ROUND(( cat.margen_ganancia * prod.costo ) + prod.costo) AS costo,
            cat.nombre AS categoria
        FROM productos AS prod
        LEFT JOIN 
            categorias AS cat
        ON 
            cat.id = prod.id_categoria
        ";
        $products = $this->executeQuery( $query );
        $count    = count( $products );

        if( $count > 0 ) {

            for( $i = 0; $i < $count; $i++ ){
                
                $id              = $products[ $i ]["id"];
                $queryAttributes = 
                "
                    SELECT 
                        attr_cat_val.valor,
                        attr_cat.nombre
                    FROM
                        productos_atributos AS prod_attr
                    LEFT JOIN 
                        atributos_categoria_valores AS attr_cat_val
                    ON 
                        prod_attr.id_atributo_categoria_valor = attr_cat_val.id
                    LEFT JOIN 
                        atributos_categoria AS attr_cat
                    ON
                        attr_cat.id = attr_cat_val.id_atributo_categoria
                    WHERE 
                        prod_attr.id_producto = '$id';
                ";

                $productAttributes = $this->executeQuery( $queryAttributes );

                $products[ $i ][ 'atributos' ] = $productAttributes;
 
            }

            return $products;

        }
        else {

            return $products;

        }

    }

    public function save( $productInput ) {

        $insertProductQuery = 
        "
            INSERT INTO 
                productos ( id, nombre, id_categoria, marca, sku, costo )
                VALUES ( 
                    uuid(), 
                    '$productInput[nombre_producto]', 
                    '$productInput[category]', 
                    '$productInput[marca]', 
                    '$productInput[sku]',
                    $productInput[costo]

                )
        ";

        $lastInsertQuery = 
        "
            SELECT 
                id
            FROM
                productos
            WHERE
                nombre       = '$productInput[nombre_producto]' AND
                id_categoria = '$productInput[category]' AND
                marca        = '$productInput[marca]' AND
                sku          = '$productInput[sku]' AND
                costo        = $productInput[costo];
        ";
                
        $this->executeInsertQuery( $insertProductQuery );
        $lastProductId = $this->executeQuery( $lastInsertQuery );
        $lastProductId = $lastProductId[ 0 ][ 'id' ];
        
        $attributeQuery = 
        "
            INSERT INTO 
                productos_atributos ( id, id_producto, id_atributo_categoria_valor )
                VALUES(
                    uuid(),
                    '$lastProductId',
                    '$productInput[attr1]'
                )
        ";

        $this->executeInsertQuery( $attributeQuery );

        $attributeQuery = 
        "
            INSERT INTO 
                productos_atributos ( id, id_producto, id_atributo_categoria_valor )
                VALUES(
                    uuid(),
                    '$lastProductId',
                    '$productInput[attr2]'
                )
        ";

        return $this->executeInsertQuery( $attributeQuery );

    }

}