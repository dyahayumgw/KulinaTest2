<?php
/**
 * Created by PhpStorm.
 * User: Dyah
 * Date: 8/8/2018
 * Time: 12:03 PM
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// get database connection
include_once '../config/database.php';

// instantiate user_review object
include_once '../objects/user_review.php';

$database = new Database();
$conn = $database->getConnection();

$user_review = new user_review($conn);

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set user review property values
$user_review->order_id = $data->order_id;
$user_review->rating = $data->rating;
$user_review->review = $data->review;

// create the user review
if (gettype($data->rating) == "double" || gettype($data->rating) == "integer") {
    if ($user_review->update()) {
        $response = array(
            'status' => 200,
            'message' => 'Update successful'
        );
    } else {
        $response = array(
            'status' => 500,
            'message' => 'Update failed'
        );
    }
} else {
    $response = array(
        'status' => 500,
        'message' => 'Rating error'
    );
}

echo json_encode($response);