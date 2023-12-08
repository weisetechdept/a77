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

    $router->get( '/livein/(.*)', function($m_id) {
        require 'sales/pages/member-livein.php';
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

    /* admin */

    $router->get( '/admin/access', function() {
        require 'admin/access.php';
    });

    $router->get( '/admin/home', function() {
        require 'admin/pages/home.php';
    });

    $router->get( '/admin/randchk-agent', function() {
        require 'admin/pages/rand_check_agent.php';
    });

    $router->get( '/admin/agent_search', function() {
        require 'admin/pages/agent_search.php';
    });

    $router->get( '/admin/apv_agent', function() {
        require 'admin/pages/apv_agent.php';
    });

    $router->get( '/admin/sales/(.*)', function($id) {
        require 'admin/pages/sales_detail.php';
    });

    /* API */

    $router->post( '/api/chk_agent77', function() {
        require 'api/get-agent.php';
       
    });
    

    $router->run();
    



