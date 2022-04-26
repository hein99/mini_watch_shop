<?php
namespace Models;
use PDO;
use PDOException;

class Admin extends DataObject
{
    protected $data = [
        'id' => '',
        'email' => '',
        'password' => '',
        'name' => '',
        'phone' => '',
        'created_at' => '',
        'modified_at' => '',
    ];

    public function insert()
    {
        try{
            $conn = parent::connect();

            $sql = 'INSERT INTO ' . TB_ADMINS . ' (
                email, 
                password, 
                name, 
                phone, 
                created_at, 
                modified_at
                ) VALUES (
                :email,
                password(:password),
                :name,
                :phone,
                now(),
                now()
                )';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
            $statement->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $statement->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
            $statement->execute();

            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getByEmail($email)
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_ADMINS . ' WHERE email=:email';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':email', $email, PDO::PARAM_STR);
            $statement->execute();

            $row = $statement->fetch();
            parent::disconnect($conn);
            if($row) return new Admin($row);
        } catch (PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getAdmin($id)
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_ADMINS . ' WHERE id=:id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();

            parent::disconnect($conn);
            if($row) return new Admin($row);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_ADMINS;

            $statement = $conn->query($sql);

            $admins = [];
            foreach($statement->fetchAll() as $row) {
                $admins[] = new Admin($row);
            }

            parent::disconnect($conn);

            return $admins;
        } catch (PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function authenticate()
    {
        try{
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_ADMINS . ' WHERE email = :email and password = password(:password)';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
            $statement->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
            $statement->execute();

            $row = $statement->fetch();
            parent::disconnect($conn);
            if($row) return new Admin($row);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function update()
    {
        try {
            $conn = parent::connect();
            $passwordSql = $this->data['password'] ? 'password = password(:password),' : '';

            $sql = "UPDATE " . TB_ADMINS . " SET
                email = :email,
                $passwordSql
                name = :name,
                phone = :phone,
                modified_at = now()

                WHERE id = :id
            ";

            $statement = $conn->prepare($sql);
            $statement->bindValue(':email', $this->data['email'], PDO::PARAM_STR);
            if($this->data['password']) $statement->bindValue(':password', $this->data['password'], PDO::PARAM_STR);
            $statement->bindValue(':name', $this->data['name'], PDO::PARAM_STR);
            $statement->bindValue(':phone', $this->data['phone'], PDO::PARAM_STR);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->execute();
            
            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function delete()
    {
        try {
            $conn = parent::connect();
        
            $sql = 'DELETE FROM ' . TB_ADMINS . ' WHERE id = :id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->execute();

            parent::disconnect($conn);
            echo 'Query: ' . $sql;
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}