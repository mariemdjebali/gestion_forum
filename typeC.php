<?php
require_once '../config.php';
require_once '../Model/type.php';

class TypeReclamationC
{
    private $db;

    public function afficherTypeReclamation()
    {
        $sql = "SELECT * FROM type_rec";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function ajouterTypeReclamation($typeReclamation)
    {
        $sql = "INSERT INTO type_rec (id_type, nom_type, id_rec) 
                VALUES (:id_type, :nom_type, :id_rec)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_type' => $typeReclamation->getIdType(),
                'nom_type' => $typeReclamation->getNomType(),
                'id_rec' => $typeReclamation->getIdRec(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function supprimerTypeReclamation($id_type)
    {
        $sql = "DELETE FROM type_rec WHERE id_type = :id_type";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_type', $id_type);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function modifierTypeReclamation($typeReclamation)
    {
        $sql = "UPDATE type_rec 
                SET nom_type = :nom_type, id_rec = :id_rec 
                WHERE id_type = :id_type";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':id_type' => $typeReclamation->getIdType(),
                ':nom_type' => $typeReclamation->getNomType(),
                ':id_rec' => $typeReclamation->getIdRec(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function afficherTypeReclamationOrderByDesc()
    {
        $sql = "SELECT * FROM type_rec ORDER BY id_type DESC";
        $db = config::getConnexion();
        return $db->query($sql);
    }

    public function searchTypeReclamation($id_type)
    {
        $sql = "SELECT * FROM type_rec WHERE id_type = :id_type";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_type' => $id_type]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    public function getTypeReclamation($id_type)
    {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('SELECT * FROM type_rec WHERE id_type = :id');
            $req->execute(['id' => $id_type]);
            $typeReclamation = $req->fetch();
            return $typeReclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    
    public function getReclamations()
    {
        $query = "SELECT id_rec, sujet FROM reclamation";
        $db = config::getConnexion();
        try {
            $result = $db->query($query);
            return $result->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }
}
?>
