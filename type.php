<?php

class TypeReclamation {
    private ?int $id_type;
    private ?string $nom_type;
    private ?int $id_rec;

    public function __construct(?int $id_type = null, ?string $nom_type = null, ?int $id_rec = null) {
        $this->id_type = $id_type;
        $this->nom_type = $nom_type;
        $this->id_rec = $id_rec;
    }

    public function getIdType(): ?int {
        return $this->id_type;
    }

    public function setIdType(?int $id_type): void {
        $this->id_type = $id_type;
    }

    public function getNomType(): ?string {
        return $this->nom_type;
    }

    public function setNomType(?string $nom_type): void {
        $this->nom_type = $nom_type;
    }

    public function getIdRec(): ?int {
        return $this->id_rec;
    }

    public function setIdRec(?int $id_rec): void {
        $this->id_rec = $id_rec;
    }
}

?>
