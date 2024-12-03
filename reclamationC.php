<?php
require_once '../config.php';
require_once '../Model/reclamation.php';

class reclamationC
{
    private $db;

    public function afficherreclamation()
    {
        $sql = "SELECT * FROM reclamation";
        $db = config::getConnexion();
        try {
            $liste = $db->query($sql);
            return $liste;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function ajouterreclamation($reclamation)
    {
        $sql = "INSERT INTO reclamation (id_rec, id_utilisateur, sujet, statut, date_rec) 
                VALUES (:id_rec, :id_utilisateur, :sujet, :statut, :date_rec)";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id_rec' => $reclamation->getIdRec(),
                'id_utilisateur' => $reclamation->getIdUtilisateur(),
                'sujet' => $reclamation->getSujet(),
                'statut' => $reclamation->getStatut(),
                'date_rec' => $reclamation->getDateRec()
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    function supprimerreclamation($id_rec)
    {
        $sql = "DELETE FROM reclamation WHERE id_rec=:id_rec";
        $db = config::getConnexion();
        $req = $db->prepare($sql);
        $req->bindValue(':id_rec', $id_rec);
        try {
            $req->execute();
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function modifierreclamation($reclamation)
    {
        $sql = "UPDATE reclamation 
                SET id_utilisateur = :id_utilisateur, sujet = :sujet, statut = :statut, date_rec = :date_rec 
                WHERE id_rec = :id_rec";
        $db = config::getConnexion();
        try {
            $stmt = $db->prepare($sql);
            $stmt->execute([
                ':id_rec' => $reclamation->getIdRec(),
                ':id_utilisateur' => $reclamation->getIdUtilisateur(),
                ':sujet' => $reclamation->getSujet(),
                ':statut' => $reclamation->getStatut(),
                ':date_rec' => $reclamation->getDateRec(),
            ]);
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    public function afficherreclamationOrderByDesc()
    {
        $sql = "SELECT * FROM reclamation ORDER BY date_rec DESC";
        $db = config::getConnexion();
        return $db->query($sql);
    }

    public function searchreclamation($id_rec)
    {
        $sql = "SELECT * FROM reclamation WHERE id_rec = :id_rec";
        $db = config::getConnexion();
        try {
            $query = $db->prepare($sql);
            $query->execute(['id_rec' => $id_rec]);
            return $query->fetchAll();
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

    
    public function getReclamation($id_rec)
    {
        $db = config::getConnexion();
        try {
            $req = $db->prepare('SELECT * FROM reclamation WHERE id_rec = :id');
            $req->execute(['id' => $id_rec]);
            $reclamation = $req->fetch();
            return $reclamation;
        } catch (Exception $e) {
            die('Error: ' . $e->getMessage());
        }
    }

    
    
}
?>
