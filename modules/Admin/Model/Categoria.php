<?php
namespace Admin\Model;
use DataBase\ModelBase;

/**
 * @table categorias
 */
class Categoria extends ModelBase{

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

    public function getRemovido(){
        return $this->removido;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    public function setRemovido($removido){
        $this->removido = (bool) $removido;
        return $this;
    }
}
