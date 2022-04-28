<?php
namespace Models;

class Banner extends DataObject
{
    protected $data = [
        'id' => '',
        'photo_name' => '',
    ];

    public function insert()
    {
        $query = 'INSERT INTO ' . TB_BANNERS . ' (photo_name) VALUES (:photo_name)';
        
        try{
            $conn = parent::connect();

            $statement = $conn->prepare($query);
            $statement->bindValue(':photo_name', $this->data['photo_name']);
            $statement->execute();

            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getAll()
    {
        $query = 'SELECT * FROM ' . TB_BANNERS;

        try{
            $conn = parent::connect();

            $statement = $conn->query($query);

            $banners = [];
            foreach($statement->fetchAll() as $row) {
                $banners[] = new Banner($row);
            }

            parent::disconnect($conn);
            
            return $banners;
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        $query = 'Delete FROM ' . TB_BANNERS . ' WHERE id=:id';

        try {
            $conn = parent::connect();

            $statement = $conn->prepare($query);
            $statement->bindValue(':id', $this->data['id']);
            $statement->execute();

            parent::disconnect($conn);
        } catch (PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}