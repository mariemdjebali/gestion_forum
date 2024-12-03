<?php

class Reclamation {
    private ?int $id_rec; // Identifiant de la réclamation
    private ?int $id_utilisateur; // Identifiant de l'utilisateur
    private ?string $sujet; // Sujet de la réclamation
    private ?string $statut; // Statut de la réclamation
    private ?string $date_rec; // Date de la réclamation

    // Constructor
    public function __construct(?int $id_rec = null, ?int $id_utilisateur = null, ?string $sujet = null, ?string $statut = null, ?string $date_rec = null) {
        $this->id_rec = $id_rec;
        $this->id_utilisateur = $id_utilisateur;
        $this->sujet = $sujet;
        $this->statut = $statut;
        $this->date_rec = $date_rec;
    }

    // Getters and Setters

    public function getIdRec(): ?int {
        return $this->id_rec;
    }

    public function setIdRec(?int $id_rec): void {
        $this->id_rec = $id_rec;
    }

    public function getIdUtilisateur(): ?int {
        return $this->id_utilisateur;
    }

    public function setIdUtilisateur(?int $id_utilisateur): void {
        $this->id_utilisateur = $id_utilisateur;
    }

    public function getSujet(): ?string {
        return $this->sujet;
    }

    public function setSujet(?string $sujet): void {
        $this->sujet = $sujet;
    }

    public function getStatut(): ?string {
        return $this->statut;
    }

    public function setStatut(?string $statut): void {
        $this->statut = $statut;
    }

    public function getDateRec(): ?string {
        return $this->date_rec;
    }

    public function setDateRec(?string $date_rec): void {
        $this->date_rec = $date_rec;
    }
}

?>
