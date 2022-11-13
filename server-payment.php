<?php

require_once('./vendor/autoload.php');

$stripe = new \Stripe\StripeClient("sk_test_51KzHTmFIeo8lkpejL9uDm8OMmgdjS4u4yq4EtLQI5rbIUwOush1zGaaPs0b5A5KrJFWaTTkYyVKAnO994sQulCNE00rFmPT0Cg");

$request_body = file_get_contents('php://input');
$data = json_decode($request_body);

header('Content-Type', 'application/json');

$session = $stripe->checkout->sessions->create([
    "success_url" => "http://localhost/himev2/payment-success.php?session_id={CHECKOUT_SESSION_ID}",
    "cancel_url" => "http://localhost/himev2/payment-cancel.php",
    "payment_method_types" => ['fpx','card'],
    "mode" => "payment",
    "client_reference_id" => "$data->job_id",
    "line_items" => [ 
        [
           "price_data" =>[
               "currency" =>"myr",
               "product_data" =>[
                   "name"=> $data->job_title, 
                   "description" => $data->f_username
               ],
               "unit_amount" => $data->bid  
           ],
           "quantity" => 1
        ],

    ]   
]);

echo json_encode($session);

?>