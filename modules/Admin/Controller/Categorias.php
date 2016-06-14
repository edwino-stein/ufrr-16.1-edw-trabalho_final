<?php
namespace Admin\Controller;
use Application\AbstractController;
use Admin\Model\Categoria;

class Categorias extends AbstractController{

    public function indexAction(){
        $categorias = Categoria::findBy(array('removido' => false));
        return self::getView(array('categorias' => $categorias));
    }

    public function createAction(){
        $categoria = null;
        $error = null;

        if($this->app()->request()->hasPost('categoria-salvar')){
            
            $categoria = new Categoria();
            $categoria->setNome($this->app()->request()->getPost('categoria-nome'));
            $categoria->setRemovido(false);

            if($categoria->save()){
                return self::getView(
                    array('message' => 'A categoria foi cadastrada com sucesso.'),
                    'categorias/operation-success.phtml'
                );
            }
            else{
                $error = 'Ocorreu algum erro durante a operação.';
            }
        }

        return self::getView(array(
            'error' => $error,
            'categoria' => $categoria
        ));
    }
}
