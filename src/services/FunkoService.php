<?php

namespace services;

use models\Funko;
use PDO;
use Ramsey\Uuid\Uuid;

require_once __DIR__ . '/../models/Funko.php';

class FunkoService{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function findAllWithCategoryName($searchTerm = null){
        $sql = "SELECT f.*, c.nombre AS categoria_nombre
        FROM funkos f 
        LEFT JOIN categorias c ON f.categoria_id = c.id";

        if($searchTerm){
            $searchTerm = '%' .strtolower($searchTerm) . '%';
            $sql .= " WHERE LOWER(f.nombre) LIKE :searchTerm";
        }

        $sql .= " ORDER BY f.id ASC";
        $stmt = $this->pdo->prepare($sql);

        if($searchTerm){
            $stmt->bindValue(':searchTerm', $searchTerm, PDO::PARAM_STR);
        }

        $stmt->execute();

        $funkos = [];
        while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
            $funko = new Funko(
                $row['id'],
                $row['nombre'],
                $row['precio'],
                $row['cantidad'],
                $row['imagen'],
                $row['created_at'],
                $row['updated_at'],
                $row['is_deleted'],
                $row['categoria_id'],
                $row['categoria_nombre']
            );
            $funkos[] = $funko;
        }
        return $funkos;
    }

    public function findById($id){
        $sql = "SELECT f.*, c.nombre AS categoria_nombre
            FROM funkos f 
            LEFT JOIN categorias c ON f.categoria_id = c.id
            WHERE f.id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$row){
            return null;
        }

        $funko = new Funko(
            $row['id'],
            $row['nombre'],
            $row['precio'],
            $row['cantidad'],
            $row['imagen'],
            $row['created_at'],
            $row['updated_at'],
            $row['is_deleted'],
            $row['categoria_id'],
            $row['categoria_nombre']
        );
        return $funko;
    }

    public function deleteById($id){
        $sql = "DELETE FROM funkos WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function update(Funko $funko){
        $sql = "UPDATE funkos SET
        nombre = :nombre,
        precio = :precio,
        cantidad = :cantidad,
        imagen = :imagen,
        categoria_id = :categoria_id,
        update_at = :updated_at
        WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nombre', $funko->nombre, PDO::PARAM_STR);
        $stmt->bindValue(':precio', $funko->precio, PDO::PARAM_STR);
        $stmt->bindValue(':cantidad', $funko->cantidad, PDO::PARAM_STR);
        $stmt->bindValue(':imagen', $funko->imagen, PDO::PARAM_STR);
        $stmt->bindValue(':categoria_id', $funko->categoriaId, PDO::PARAM_STR);
        $funko->updatedAt = date('Y-m-d H:i:s');
        $stmt->bindValue(':updatedAt', $funko->updatedAt, PDO::PARAM_STR);
        $stmt->bindValue(':id', $funko->id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    public function save(Funko $funko){
        $sql = "INSERT INTO funkos (nombre, precio, cantidad, imagen, categoria_id, created_at, updated_at)
            VALUES(:nombre, :precio, :cantidad, :imagen, :categoria_id, :created_at, :updated_at)";

        $stmt = $this->pdo->prepare($sql);

        $stmt->bindValue(':nombre', $funko->nombre, PDO::PARAM_STR);
        $stmt->bindValue(':precio', $funko->precio, PDO::PARAM_STR);
        $stmt->bindValue(':cantidad', $funko->cantidad, PDO::PARAM_STR);
        $funko->imagen = Funko::$IMAGEN_DEFAULT;
        $stmt->bindValue(':categoria_id', $funko->categoriaId, PDO::PARAM_INT);
        $funko->createdAt = date('Y-m-d H:i:s');
        $stmt->bindValue(':created_at', $funko->createdAt, PDO::PARAM_STR);
        $funko->updatedAt = date('Y-m-d H:i:s');
        $stmt->bindValue(':updated_at', $funko->updatedAt, PDO::PARAM_STR);

        return $stmt->execute();
    }
}
?>