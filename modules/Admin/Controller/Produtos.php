<?php
namespace Admin\Controller;
use Application\AbstractController;
use Admin\Model\Produto;
use Admin\Model\Categoria;

class Produtos extends AbstractController{

    public function indexAction(){

        $produtos = Produto::findBy(array('removido' => false));

        $categoriasModels = Categoria::fetchAll();
        $categorias = array();
        foreach($categoriasModels as $c) $categorias[$c->getId()] = $c;

        return self::getView(array('produtos' => $produtos, 'categorias' => $categorias));
    }

    public function createAction(){
        return self::getView(array());
    }

}
