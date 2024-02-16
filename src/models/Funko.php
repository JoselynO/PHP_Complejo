<?php

namespace  models;

class Funko{
    public static $IMAGEN_DEFAULT = 'https://via.placeholder.com/150';
    private $id;
    private $nombre;
    private $precio;
    private $cantidad;
    private $imagen;
    private $createdAt;
    private $updatedAt;
    private $isDeleted;
    private $categoriaId;
    private $categoriaNombre;

    public function __construct($id = null, $nombre = null, $precio = null, $cantidad = null, $imagen = null, $createdAt = null, $updatedAt = null, $isDeleted = null, $categoriaId = null, $categoriaNombre = null){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->imagen = $imagen;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->isDeleted = $isDeleted;
        $this->categoriaId = $categoriaId;
        $this->categoriaNombre = $categoriaNombre;
    }

    public function __get($name){
        return $this->$name;
    }

    public function __set($name, $value){
        $this->$name = $value;
    }
}
?>