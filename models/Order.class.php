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

    private $_status = [
        'ordered' => 'Ordered',
        'processing' => 'Processing',
        'shipped' => 'Shipped',
        'completed' => 'Completed',
        'cancelled' => 'Cancelled'
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

    public static function getOrder($id) {
        try {
            $conn = parent::connect();

            $sql = 'SELECT * FROM ' . TB_ORDERS . ' WHERE id = :id';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':id', $id, PDO::PARAM_INT);
            $statement->execute();

            $row = $statement->fetch();

            parent::disconnect($conn);

            if($row) return new Order($row);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }
    
    public static function getOrderByTrackingCode($tracking_code) {
            try {
                $conn = parent::connect();

                $sql = 'SELECT * FROM ' . TB_ORDERS . ' WHERE tracking_code = :tracking_code';

                $statement = $conn->prepare($sql);
                $statement->bindValue(':tracking_code', $tracking_code, PDO::PARAM_STR);
                $statement->execute();

                $row = $statement->fetch();

                parent::disconnect($conn);

                if($row) return new Order($row);
            } catch(PDOException $e) {
                die('Query failed: ' . $e->getMessage());
            }
        }

    
        public static function getOrders( $start_row, $num_rows, $status = null)
    {
        try {
            $conn = parent::connect();

            $status_str = '';
            if($status) $status_str = ' WHERE status = :status';

            $sql = 'SELECT SQL_CALC_FOUND_ROWS * FROM ' . TB_ORDERS . $status_str . ' ORDER BY created_at desc LIMIT :start_row, :num_rows';
            $statement = $conn->prepare($sql);
            $statement->bindValue(':start_row', $start_row, PDO::PARAM_INT);
            $statement->bindValue(':num_rows', $num_rows, PDO::PARAM_INT);
            if($status) $statement->bindValue(':status', $status, PDO::PARAM_STR);
            $statement->execute();

            $orders = [];
            foreach($statement->fetchAll() as $row)
            {
                $orders[] = new Order($row);
            }

            $statement = $conn->query( 'SELECT found_rows() AS totalRows' );
            $row = $statement->fetch();

            parent::disconnect($conn);
            return [$orders, $row['totalRows']];
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function update() {
        try {
            $conn = parent::connect();

            $sql = 'UPDATE ' . TB_ORDERS . ' SET 
            customer_name = :customer_name, 
            customer_phone = :customer_phone,
            customer_address = :customer_address,
            watch_id = :watch_id,
            status = :status,
            modified_at = now()

            WHERE id = :id
            ';

            $statement = $conn->prepare($sql);
            $statement->bindValue(':customer_name', $this->data['customer_name'], PDO::PARAM_STR);
            $statement->bindValue(':customer_phone', $this->data['customer_phone'], PDO::PARAM_STR);
            $statement->bindValue(':customer_address', $this->data['customer_address'], PDO::PARAM_STR);
            $statement->bindValue(':watch_id', $this->data['watch_id'], PDO::PARAM_INT);
            $statement->bindValue(':status', $this->data['status'], PDO::PARAM_STR);
            $statement->bindValue(':id', $this->data['id'], PDO::PARAM_INT);
            $statement->execute();

            parent::disconnect($conn);
        } catch(PDOException $e) {
            die('Query failed: ' . $e->getMessage());
        }
    }

    public function getStatusString() {
        return $this->_status[$this->data['status']];
    }

    
}