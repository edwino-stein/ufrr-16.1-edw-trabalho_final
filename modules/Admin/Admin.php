<?php
namespace Admin;
use Application\Application;

class Admin extends Application{
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
        'defaultController' => 'produtos'
    );
}
