<?php
namespace Admin\Model;
use DataBase\ModelBase;

/**
 * @table produtos
 */
class Produto extends ModelBase{

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
     * @var string
     * @column thumbnail
     */
    protected $thumbnail;

    /**
     * @var string
     * @column thumbnail_mime
     */
    protected $thumbnailType;

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

    public function getThumbnail(){
        return $this->thumbnail;
    }

    public function getThumbnailType(){
        return $this->thumbnailType;
    }

    public function getRemovido(){
        return $this->removido;
    }

    public function setId($id){
        $this->id = (int) $id;
        return $this;
    }

    public function setNome($nome){
        $this->nome = $nome;
        return $this;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
        return $this;
    }

    public function setValor($valor){
        $this->valor = (float) $valor;
        return $this;
    }

    public function setCategoria($categoria){
        $this->categoria = (int) $categoria;
        return $this;
    }

    public function setRemovido($removido){
        $this->removido = (bool) $removido;
        return $this;
    }

    public function setThumbnail($thumbnail){
        $this->thumbnail = $thumbnail;
        return $this;
    }

    public function setThumbnailType($thumbnailType){
        $this->thumbnailType = $thumbnailType;
        return $this;
    }
}
