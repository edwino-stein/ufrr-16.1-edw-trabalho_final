<?php
namespace Shop\Controller;
use Application\AbstractController;
use Shop\Model\ProdutoView;

class Cart extends AbstractController{

    public function indexAction(){

        $addCart = $this->app()->request()->getQuery('add', null);
        if($addCart !== null) $this->addToCart((int) $addCart);


        $cart = $this->getCartItens();
        $itens = array();
        $model = null;

        foreach ($cart as $id) {
            $model = ProdutoView::findOneBy(array('id' => $id));
            if($model === null) continue;
            $itens[] = $model;
        }

        return self::getView(array(
            'itens' => $itens,
            'total' => count($itens),
        ));
    }

    public function clearAction(){
        session_destroy();
        $url = $this->app()->request()->getBaseUri().$this->app()->request()->getScriptName();
        header("Location: ".$url.'/cart/index');
        return 'clean';
    }

    protected function addToCart($id){
        if(!in_array($id, $_SESSION['cart']))
             $_SESSION['cart'][] = $id;
    }

    protected function getCartItens(){
        return isset($_SESSION['cart']) && is_array($_SESSION['cart']) ? $_SESSION['cart'] : array();
    }

}
