<?php
namespace Shop\Controller;

use Application\AbstractController;
use DataBase\Where;
use Admin\Model\Categoria;
use Shop\Model\ProdutoView;
use Shop\Model\ProdutoThumbnail;

class Shop extends AbstractController{

    public function indexAction(){

        $categorias = Categoria::findBy(array('removido' => false), array('offset' => 0, 'limit' => 5));
        $produtos = array();
        foreach ($categorias as $key => $c) {
            $produtos[$key] = ProdutoView::findBy(
                array('removido' => false, 'categoria' => $c->getId()),
                array('offset' => 0, 'limit' => 4)
            );
        }

        return self::getView(array('categorias' => $categorias, 'produtos' => $produtos));
    }

    public function produtoAction(){

        $produtoId = $this->app()->request()->getQuery('produto_id');
        $produto = ProdutoView::findOneBy(array('removido' => false, 'id' => $produtoId));

        if($produto === null) return self::getView(array(), 'shop/produto-invalido.phtml');

        return self::getView(array('produto' => $produto));
    }

    public function categoriaAction(){

        $categoriaId = $this->app()->request()->getQuery('categoria');
        $categoria = Categoria::findOneBy(array('removido' => false, 'id' => $categoriaId));
        if($categoria == null) return self::getView(array(), 'shop/categoria-invalida.phtml');

        $produtos = ProdutoView::findBy(array('removido' => false, 'categoria' => $categoriaId));
        return self::getView(array('produtos' => $produtos, 'categoria' => $categoria));
    }

    public function pesquisaAction(){
        $busca = $this->app()->request()->getQuery('buscar', '');

        if(empty($busca)) $produtos = array();
        else $produtos = ProdutoView::findBy(new Where('nome like :nome and removido = :removido', array('nome' => '%'.$busca.'%', 'removido' => false)));
        
        $total = count($produtos);
        return self::getView(array('produtos' => $produtos, 'total' => $total));
    }

    public function thumbnailAction(){

        $this->template = null;
        $produtoId = $this->app()->request()->getQuery('produto_id', null);
        $produto = ProdutoThumbnail::findOneBy(array('id' => $produtoId));

        if($produto == null || empty($produto->getThumbnail())){
            $public = $this->app()->getDir('public');
            $noThumbnail = $public.'/img/sem-foto.png';
            header('Content-Type: '.mime_content_type($noThumbnail));
            return file_get_contents($noThumbnail);
        }
        else {
            header('Content-Type: '.$produto->getThumbnailType());
            return base64_decode($produto->getThumbnail());
        }
    }

}
