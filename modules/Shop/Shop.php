<?php
namespace Shop;
use Application\Application;

class Shop extends Application{

    protected function init(){
        session_start();
        if(!isset($_SESSION['cart'])) $_SESSION['cart'] = array();
        parent::init();
    }

    protected $config = array(
        'db' => array(
            'driver' => 'mysql',
            'dbname' => 'web_final1',
            'user' => 'web_final1',
            'password' => '123456'
        ),
        'view' => array(
            'charset' => 'UTF-8',
            'contentName' => 'content',
            'noTemplate' => false,
            'defaultTemplate' => 'template.phtml'
        ),
        'defaultController' => 'shop'
    );
}
