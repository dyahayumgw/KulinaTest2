<?php
/**
 * Created by PhpStorm.
 * User: Ryandhimas
 * Date: 8/7/2018
 * Time: 8:58 PM
 */

class user_review
{
    // database connection
    private $conn;
    private $table_name = "user_review";

    // object properties
    public $id;
    public $order_id;
    public $product_id;
    public $user_id;
    public $rating;
    public $review;
    public $created_at;
    public $updated_at;

    /**
     * userreview constructor.
     * @param $conn
     */
    public function __construct($conn)
    {
        $this->conn = $conn;
    }

    // Create
    function create()
    {

        // query to insert record
        $query = "INSERT INTO " . $this->table_name . " SET
                    order_id=:order_id, product_id=:product_id, user_id=:user_id, rating=:rating, review=:review, created_at=:created_at";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->product_id = htmlspecialchars(strip_tags($this->product_id));
        $this->user_id = htmlspecialchars(strip_tags($this->user_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->review = htmlspecialchars(strip_tags($this->review));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        // bind values
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":product_id", $this->product_id);
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":review", $this->review);
        $stmt->bindParam(":created_at", $this->created_at);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Read
    public function read() {
        // select all query
        $query = "SELECT * FROM " . $this->table_name . " WHERE 1";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    // Update
    function update()
    {

        // query to update record
        $query = "UPDATE " . $this->table_name . " SET rating=:rating, review=:review WHERE order_id=:order_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));
        $this->rating = htmlspecialchars(strip_tags($this->rating));
        $this->review = htmlspecialchars(strip_tags($this->review));

        // bind values
        $stmt->bindParam(":order_id", $this->order_id);
        $stmt->bindParam(":rating", $this->rating);
        $stmt->bindParam(":review", $this->review);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }

    // Delete
    function delete()
    {

        // query to delete record
        $query = "DELETE FROM " . $this->table_name . " WHERE order_id=:order_id";

        // prepare query
        $stmt = $this->conn->prepare($query);

        // sanitize
        $this->order_id = htmlspecialchars(strip_tags($this->order_id));

        // bind values
        $stmt->bindParam(":order_id", $this->order_id);

        // execute query
        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}