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
        'photo_name' => '',
        'photo_qty' => '',
        'created_at' => '',
        'modified_at' => '',
    ];

    public function insert()
    {
        try {
            $conn = parent::connect();

            $sql = 'INSERT INTO ' . TB_PRODUCTS . ' (
                name,
                description,
                category_id,
                price,
                discount_percentage,
                is_out_of_stock,
                created_at,
                modified_at
            ) VALUES (
                :name,
                :description,
                :category_id,
                :price,
                :discount_percentage,
                :is_out_of_stock,
                now(),
                now()
            )';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $statement->bindValue(':description', $this->data['description'], PDO::PARAM_STR);
            $statement->bindValue(':category_id', $this->data['category_id'], PDO::PARAM_INT);
            $statement->bindValue(':price', $this->data['price'], PDO::PARAM_INT);
            $statement->bindValue(':discount_percentage', $this->data['discount_percentage'], PDO::PARAM_INT);
            $statement->bindValue(':is_out_of_stock', $this->data['is_out_of_stock'], PDO::PARAM_INT);
            $statement->execute();
            
            parent::disconnect($conn);

        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function getFinalPrice()
    {
        return number_format($this->data['price'] - ($this->data['price'] * $this->data['discount_percentage'] / 100));
    }

    public static function getProduct($id)
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_PRODUCTS . ' WHERE id = :id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();
        
            parent::disconnect($conn);

            if($row) return new Product($row);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

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

    public function update()
    {
        try {
            $conn = parent::connect();

            $sql = 'UPDATE ' . TB_PRODUCTS . ' SET
                name = :name,
                description = :description,
                category_id = :category_id,
                price = :price,
                discount_percentage = :discount_percentage,
                is_out_of_stock = :is_out_of_stock,
                modified_at = now()

                WHERE id = :id
            ';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $statement->bindValue(':description', $this->data['description'], PDO::PARAM_STR);
            $statement->bindValue(':category_id', $this->data['category_id'], PDO::PARAM_INT);
            $statement->bindValue(':price', $this->data['price'], PDO::PARAM_INT);
            $statement->bindValue(':discount_percentage', $this->data['discount_percentage'], PDO::PARAM_INT);
            $statement->bindValue(':is_out_of_stock', $this->data['is_out_of_stock'], PDO::PARAM_INT);
            $statement->execute();

            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function updatePhoto()
    {
        try {
            $conn = parent::connect();

            $sql = 'UPDATE ' . TB_PRODUCTS . ' SET
                photo_qty = :photo_qty,
                photo_name = :photo_name,
                modified_at = now()

                WHERE id = :id
            ';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->bindValue(':photo_qty', $this->data['photo_qty'], PDO::PARAM_INT);
            $statement->bindValue(':photo_name', $this->data['photo_name'], PDO::PARAM_STR);
            $statement->execute();

            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}