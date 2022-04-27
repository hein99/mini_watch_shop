<?php
namespace Models;

use PDO;
use PDOException;

class Product extends DataObject
{
    protected $data = [
        'id' => '',
        'name' => '',
        'description' => '',
        'category_id' => '',
        'price' => '',
        'discount_percentage' => '',
        'is_out_of_stock' => '',
        'created_at' => '',
        'modified_at' => '',
    ];

    public static function getByCategoryID($category_id)
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_PRODUCTS . ' WHERE category_id = :category_id';
            
            $statement = $conn->prepare($sql);
            $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $statement->execute();

            $products = [];
            foreach($statement->fetchAll() as $row) {
                $products[] = new Product($row);
            }

            parent::disconnect($conn);
            return $products;          
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function deleteByCategoryID($category_id)
    {
        try {
            $conn = parent::connect();

            $sql = 'DELETE FROM ' . TB_PRODUCTS . ' WHERE category_id = :category_id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':category_id', $category_id, PDO::PARAM_INT);
            $statement->execute();
            
            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}