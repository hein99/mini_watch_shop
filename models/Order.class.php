<?php

namespace Models;

use PDO;
use PDOException;

class Order Extends DataObject 
{
    protected $data = [
        'id' => '',
        'customer_name' => '',
        'customer_phone' => '',
        'customer_address' => '',
        'watch_id' => '',
        'tracking_code' => '',
        'status' => '',
        'created_at' => '',
        'modified_at' => ''
    ];

    public function insert() 
    {
        try {
            $conn = parent::connect();

            $sql = 'INSERT INTO ' . TB_ORDERS . ' (
                customer_name,
                customer_phone,
                customer_address,
                watch_id,
                tracking_code,
                status,
                created_at,
                modified_at
            ) VALUES (
                :customer_name,
                :customer_phone,
                :customer_address,
                :watch_id,
                :tracking_code,
                \'ordered\',
                now(),
                now()
            )';
            $statement = $conn->prepare($sql);
            $statement->bindValue(':customer_name', $this->data['customer_name'], PDO::PARAM_STR);
            $statement->bindValue(':customer_phone', $this->data['customer_phone'], PDO::PARAM_STR);
            $statement->bindValue(':customer_address', $this->data['customer_address'], PDO::PARAM_STR);
            $statement->bindValue(':watch_id', $this->data['watch_id'], PDO::PARAM_INT);
            $statement->bindValue(':tracking_code', $this->data['tracking_code'], PDO::PARAM_STR);
            $statement->execute();

            parent::disconnect($conn);
        } catch (PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
}