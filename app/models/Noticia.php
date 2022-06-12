<?php

use Phalcon\Mvc\Model;
use Phalcon\Paginator\Adapter\Model as Paginator;

class Noticia extends Model
{
    protected $id;

    protected $titulo;

    protected $texto;

    protected $data_ultima_atualizacao;

    protected $data_cadastro;

    public function initialize()
    {
        $this->setSource("noticia");   
    }


    function getId() {
        return (int) $this->id;
    }

    function get($campo) {
        if ( in_array($campo, ['data_cadastro', 'data_ultima_atualizacao']))
            return str_replace('-','/',$this->$campo);
        return $this->$campo;
    }

    function set($campo, $valor) {
        if (
            in_array(
                $campo,
                ['id', 'data_ultima_atualizacao', 'data_cadastro'])
            )  return false;
        $this->$campo = $valor;
    }

    public function beforeCreate()
    {
        //Set the creation date
        $this->data_cadastro = date('Y-m-d H:i:s');
        $this->data_ultima_atualizacao = $this->data_cadastro;     
    }

    public function beforeUpdate()
    {
        //Set the creation date
        $this->data_ultima_atualizacao = date('Y-m-d H:i:s');
    }
    
}