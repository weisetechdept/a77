<?php
    require 'vendor/autoload.php';
    $router = new \Bramus\Router\Router();

    $router->get( '/', function() {
        header("location: /404");
		exit();
    });

    $router->get( '/404', function() {
        require 'error/404.php';
    });

    $router->get( '/500', function() {
        require 'error/500.php';
    });

    $router->get( '/auth', function() {
        require 'auth.php';
    });

    $router->get( '/logout', function() {
        require 'logout.php';
    });

    /* Sales */

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

    /* mgr */

    $router->get( '/mgr/home', function() {
        require 'mgr/pages/home.php';
    });

    $router->run();
    



