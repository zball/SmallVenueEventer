<?php

namespace AppBundle\Service;

use Stripe\Stripe;
use Stripe\Customer;

class StripeProcessor implements PaymentManagerInterface{

    private $token;
    private $customer;

    public function __construct($apiKey){
        $this->setApiKey($apiKey);
    }

    public function setApiKey($apiKey){
        \Stripe\Stripe::setApiKey($apiKey);
    }

    public function setToken($token){
        $this->token = $token;
    }

    public function charge(array $options){
        \Stripe\Charge::create($options);
    }

    public function createCustomer($email){

        try {
            // Create a Customer
            $this->customer = \Stripe\Customer::create(array(
                    "source" => $this->token,
                    "email" => $email)
            );
        } catch(\Stripe\Error\Card $e) {
            // The card has been declined
        }
    }

    public function setCustomerById($customerId){
        $this->customer = \Stripe\Customer::retrieve($customerId);
    }

    public function getCustomer(){
        return $this->customer;
    }

}