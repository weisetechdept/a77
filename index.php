<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header("location: /404");
		exit();
    });

    $router->get( '/auth', function() {
        require 'auth.php';
    });

    $router->get( '/home', function() {
        require 'sales/pages/home.php';
    });

    $router->get( '/map', function() {
        require 'sales/pages/map.php';
    });

    $router->get( '/register', function() {
        require 'sales/pages/register.php';
    });

    $router->get( '/profile/(.*)', function($m_id) {
        require 'sales/pages/member-profile.php';
    });

    $router->run();
    



