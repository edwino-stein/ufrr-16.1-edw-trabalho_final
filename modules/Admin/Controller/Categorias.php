<?php
namespace Admin\Controller;
use Application\AbstractController;
use Admin\Model\Categoria;

class Categorias extends AbstractController{

    public function indexAction(){
        $categorias = Categoria::findBy(array('removido' => false));
        return self::getView(array('categorias' => $categorias));
    }
}
