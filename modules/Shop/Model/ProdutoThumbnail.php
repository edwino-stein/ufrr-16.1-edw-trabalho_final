<?php
namespace Shop\Model;
use DataBase\ModelBase;

/**
 * @table produtos
 */
class ProdutoThumbnail extends ModelBase{

    /**
     * @var int
     * @id
     * @column id
     */
    protected $id;

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

    public function getId(){
        return $this->id;
    }

    public function getThumbnailType(){
        return $this->thumbnailType;
    }

    public function getThumbnail(){
        return $this->thumbnail;
    }

}
