<?php
namespace Shop;
use Application\Application;

class Shop extends Application{
    protected $config = array(
        'db' => array(),
        'view' => array(
            'charset' => 'UTF-8',
            'contentName' => 'content',
            'noTemplate' => false,
            'defaultTemplate' => 'template.phtml'
        ),
        'defaultController' => 'home'
    );
}
