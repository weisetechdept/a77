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

    $router->get( '/edit/(.*)', function($m_id) {
        require 'sales/pages/member-edit.php';
    });

    $router->get( '/agent/(.*)', function($page) {
        require 'sales/pages/agent.php';
    });

    /* mgr */

    $router->get( '/mgr/home', function() {
        require 'mgr/pages/home.php';
    });

    $router->get( '/mgr/agent/(.*)', function($page) {
        require 'mgr/pages/agent.php';
    });

    $router->get( '/mgr/profile/(.*)', function($m_id) {
        require 'mgr/pages/agent-profile.php';
    });

    $router->get( '/mgr/sales/(.*)', function($sales) {
        require 'mgr/pages/sales.php';
    });

    $router->get( '/mgr/map', function() {
        require 'mgr/pages/map.php';
    });

    $router->run();
    



