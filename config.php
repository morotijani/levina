<?php

    define('BASEURL', $_SERVER['DOCUMENT_ROOT'] . '/namibra_product_referral_system/');
        
    define('PROOT', '/namibra_product_referral_system/');

    // Load the environment variables from the .env file
    define('RECAPTCHA_SITE_KEY_PUBLIC', $_ENV['RECAPTCHA_SITE_KEY_PUBLIC']);
    define('RECAPTCHA_SITE_KEY_SECRETE', $_ENV['RECAPTCHA_SITE_KEY_SECRETE']);
    define('RECAPTCHA_KEY', $_ENV['RECAPTCHA_KEY']);

    define('MAIL_EMAIL', $_ENV['MAIL_EMAIL']);
    define('MAIL_KEY', $_ENV['MAIL_KEY']);
    define('MAIL_HOST', $_ENV['MAIL_HOST']);
    define('MAIL_PORT', $_ENV['MAIL_PORT']);

    define('IPINFO_KEY', $_ENV['IPINFO_KEY']);

    define ('COINCAP_APIKEY', $_ENV['COINCAP_APIKEY']);
