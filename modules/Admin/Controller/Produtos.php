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

            $thumbnail = $this->getFile('produto-imagem');
            if($thumbnail !== null){
                $produto->setThumbnail($thumbnail['blob']);
                $produto->setThumbnailType($thumbnail['type']);
            }
            else if($this->app()->request()->hasPost('produto-imagem-reupdate')){
                $produto->setThumbnail($this->app()->request()->getPost('produto-imagem-reupdate'));
                $produto->setThumbnailType($this->app()->request()->getPost('produto-imagem-reupdate-type'));
            }

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

    public function updateAction(){

        if(!$this->app()->request()->hasQuery('produto_id')){
            return 'Nenhum produto especificado';
        }

        $id = $this->app()->request()->getQuery('produto_id');
        $produto = Produto::findOneBy(array('id' => $id));
        $error = null;

        if($produto === null){
            return 'Nenhum produto especificado';
        }

        if($this->app()->request()->hasPost('produto-salvar')){

            $produto->setNome($this->app()->request()->getPost('produto-nome'));
            $produto->setValor($this->app()->request()->getPost('produto-valor'));
            $produto->setCategoria($this->app()->request()->getPost('produto-categoria'));
            $produto->setDescricao($this->app()->request()->getPost('produto-descricao'));

            $thumbnail = $this->getFile('produto-imagem');
            if($thumbnail !== null){
                $produto->setThumbnail($thumbnail['blob']);
                $produto->setThumbnailType($thumbnail['type']);
            }
            else if($this->app()->request()->hasPost('produto-imagem-reupdate')){
                $produto->setThumbnail($this->app()->request()->getPost('produto-imagem-reupdate'));
                $produto->setThumbnailType($this->app()->request()->getPost('produto-imagem-reupdate-type'));
            }

            if($produto->save()){
                return self::getView(
                    array('message' => 'O produto foi editado com sucesso.'),
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

    public function deleteAction(){

        if(!$this->app()->request()->hasQuery('produto_id')){
            return 'Nenhum produto especificado';
        }

        $id = $this->app()->request()->getQuery('produto_id');
        $produto = Produto::findOneBy(array('id' => $id));

        if($produto === null){
            return 'Nenhum produto especificado';
        }

        $produto->setRemovido(true);

        if($produto->save()){
            return self::getView(
                array('message' => 'O produto foi removido com sucesso.'),
                'produtos/operation-success.phtml'
            );
        }
        else{
            return 'Ocorreu algum erro durante a operação.';
        }
    }

    protected function getCategorias(){
        $categoriasModels = Categoria::fetchAll();
        $categorias = array();
        foreach($categoriasModels as $c) $categorias[$c->getId()] = $c;
        return $categorias;
    }

    protected function getFile($key){

        if(!isset($_FILES[$key]) || $_FILES[$key]['error'] !== 0) return null;

        return array(
            'blob' => base64_encode(file_get_contents($_FILES[$key]['tmp_name'])),
            'type' => $_FILES[$key]['type']
        );
    }

}
