<?php
namespace Shop\Controller;
use Application\AbstractController;

class Home extends AbstractController{

    protected $defaultAction = 'index';

    public function indexAction(){
        return self::getView(array('teste' => 'Olá mundo'));
    }
}
