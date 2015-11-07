<?php

namespace AppBundle\Service;


abstract class PaymentProcessor implements PaymentManagerInterface{

    private $apiKey;
    private $customer;

    public function __construct($apiKey){
        $this->apiKey = $apiKey;
    }

    public function getApiKey(){
        return $this->getApiKey();
    }

    public function createCustomer(){
        $this->customer = uniqid();
    }

    public function getCustomer(){
        return $this->customer;
    }

}