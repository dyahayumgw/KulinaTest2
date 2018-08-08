<?php
/**
 * Created by PhpStorm.
 * User: Dyah
 * Date: 8/7/2018
 * Time: 9:22 PM
 */

// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/database.php';
include_once '../objects/user_review.php';

// instantiate database and user review object
$database = new Database();
$conn = $database->getConnection();

// initialize object
$user_review = new user_review($conn);

// query user review
$stmt = $user_review->read();
$num = $stmt->rowCount();

if($num>0){

    // user reviews array
    $user_review_arr=array();
    $user_review_arr["records"]=array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);

        $user_review_item=array(
            "order_id" => $order_id,
            "product_id" => $product_id,
            "user_id" => $user_id,
            "rating" => $rating,
            "review" => $review
        );

        array_push($user_review_arr["records"], $user_review_item);
    }

    echo json_encode($user_review_arr);
}

else{
    echo json_encode(
        array("message" => "No user reviews found.")
    );
}