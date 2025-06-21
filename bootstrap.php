<?php
    
    // AUTO LOAD VENDOR FILES
    require dirname(__DIR__)  . '/namibra_product_referral_system/vendor/autoload.php';

    
    // LOAD DOTENV
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
