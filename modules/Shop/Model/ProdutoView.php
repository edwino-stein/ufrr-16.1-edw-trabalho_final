<?php
namespace Shop\Model;
use DataBase\ModelBase;

/**
 * @table produtos
 */
class ProdutoView extends ModelBase{

    /**
     * @var int
     * @id
     * @column id
     */
    protected $id;

    /**
     * @var string
     * @column nome
     * @length 100
     */
    protected $nome;

    /**
     * @var string
     * @column descricao
     */
    protected $descricao;

    /**
     * @var float
     * @column valor
     */
    protected $valor;

    /**
     * @var int
     * @column categoria
     */
    protected $categoria;

    /**
     * @var bool
     * @column removido
     */
    protected $removido;


    public function getId(){
        return $this->id;
    }

    public function getNome(){
        return $this->nome;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function getValor(){
        return $this->valor;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function getRemovido(){
        return $this->removido;
    }
}
