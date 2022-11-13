<?php

require './vendor/autoload.php';

$session_id = 'cs_test_a1SkiLEWtHR7GDS6kLftwNY7T6Cq8bWyb1lqCohBQZUkFhVBpzCAJ0n89z';

\Stripe\Stripe::setApiKey('sk_test_51KzHTmFIeo8lkpejL9uDm8OMmgdjS4u4yq4EtLQI5rbIUwOush1zGaaPs0b5A5KrJFWaTTkYyVKAnO994sQulCNE00rFmPT0Cg');
$checkout_session = \Stripe\Checkout\Session::retrieve($session_id);
$intent = \Stripe\PaymentIntent::retrieve($checkout_session->payment_intent);
$customer = \Stripe\Customer::retrieve($checkout_session->customer);

if($intent->status == 'succeeded'){
    echo $intent;
}else{
    echo 'Fail';
}


?>