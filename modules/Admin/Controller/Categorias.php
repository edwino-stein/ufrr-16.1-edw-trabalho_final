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

    public function updateAction(){

        if(!$this->app()->request()->hasQuery('categoria_id')){
            return 'Nenhuma categoria especificada';
        }

        $id = $this->app()->request()->getQuery('categoria_id');
        $categoria = Categoria::findOneBy(array('id' => $id));
        $error = null;

        if($categoria === null){
            return 'Nenhuma categoria especificada';
        }


        if($this->app()->request()->hasPost('categoria-salvar')){

            $categoria->setNome($this->app()->request()->getPost('categoria-nome'));

            if($categoria->save()){
                return self::getView(
                    array('message' => 'A categoria foi editada com sucesso.'),
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
