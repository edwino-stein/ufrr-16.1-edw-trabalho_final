<?php
namespace Admin\Controller;
use Application\AbstractController;
use Admin\Model\Produto;
use Admin\Model\Categoria;

class Produtos extends AbstractController{

    public function indexAction(){
        $produtos = Produto::findBy(array('removido' => false));
        return self::getView(array('produtos' => $produtos, 'categorias' => $this->getCategorias()));
    }

    public function createAction(){
        $produto = null;
        $error = null;
        if($this->app()->request()->hasPost('produto-salvar')){

            $produto = new Produto();
            $produto->setNome($this->app()->request()->getPost('produto-nome'));
            $produto->setValor($this->app()->request()->getPost('produto-valor'));
            $produto->setCategoria($this->app()->request()->getPost('produto-categoria'));
            $produto->setDescricao($this->app()->request()->getPost('produto-descricao'));
            $produto->setRemovido(false);

            if($produto->save()){
                return self::getView(
                    array('message' => 'O produto foi cadastrado com sucesso.'),
                    'produtos/operation-success.phtml'
                );
            }
            else{
                $error = 'Ocorreu algum erro durante a operação.';
            }
        }

        return self::getView(array(
            'categorias' => $this->getCategorias(),
            'error' => $error,
            'produto' => $produto
        ));
    }

    protected function getCategorias(){
        $categoriasModels = Categoria::fetchAll();
        $categorias = array();
        foreach($categoriasModels as $c) $categorias[$c->getId()] = $c;
        return $categorias;
    }
}
