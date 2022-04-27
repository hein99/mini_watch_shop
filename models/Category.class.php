<?php
namespace Models;

use PDO;
use PDOException;

class Category Extends DataObject
{
    protected $data = [
        'id' => '',
        'name' => '',
        'photo_name' => '',
    ];

    public function insert()
    {
        try {
            $conn = parent::connect();

            $photo_name = ($this->data['photo_name']) ? ', photo_name' : '';
            $photo_name_1 = ($this->data['photo_name']) ? ', :photo_name' : '';

            $sql = 'INSERT INTO ' . TB_CATEGORIES . " (
                name
                $photo_name
            ) VALUES (
                :name
                $photo_name_1
            )";
            echo $sql . '<br>';
            $statement = $conn->prepare($sql);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            if($this->data['photo_name'])
                $statement->bindValue(':photo_name', $this->data['photo_name'], PDO::PARAM_STR);
            $statement->execute();
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getCategory($id)
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_CATEGORIES . ' WHERE id = :id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();

            parent::connect($conn);

            if($row) return new Category($row);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_CATEGORIES;

            $statement = $conn->query($sql);

            $categories = [];
            foreach($statement->fetchAll() as $row)
            {
                $categories[] = new Category($row);
            }
            parent::disconnect($conn);
            return $categories;
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $conn = parent::connect();

            $photo_name = ($this->data['photo_name']) ? ', photo_name = :photo_name' : '';

            $sql = 'UPDATE ' . TB_CATEGORIES . " SET 
            name = :name
            $photo_name

            WHERE id = :id
            ";
            $statement = $conn->prepare($sql);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            if($this->data['photo_name'])
                $statement->bindValue(':photo_name', $this->data['photo_name'], PDO::PARAM_STR);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->execute();

            parent::connect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $conn = parent::connect();

            $sql = 'DELETE FROM ' . TB_CATEGORIES . ' WHERE id = :id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->execute();

            parent::connect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}