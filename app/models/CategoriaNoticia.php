<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class CategoriaNoticia extends Model
{
    protected $id_noticia;

    protected $id_categoria;


    public function initialize()
    {
        $this->setSource("categoria_noticia");

        $this->belongsTo(
            'id_noticia',
            Noticia::class,
            'id',
            [
                'foreignKey' => true
            ]
        );

        $this->belongsTo(
            'id_categoria',
            'Categoria',
            'id',
            [
                'foreignKey' => true
            ]
        );

    }
    
}