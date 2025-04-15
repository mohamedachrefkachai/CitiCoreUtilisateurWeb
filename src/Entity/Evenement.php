<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use App\Entity\Utilisateur;

#[ORM\Entity]
class Evenement
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $id_evenement;

        #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: "evenements")]
    #[ORM\JoinColumn(name: 'categorie_id', referencedColumnName: 'categorie_id', onDelete: 'CASCADE')]
    private Categorie $categorie_id;

        #[ORM\ManyToOne(targetEntity: Utilisateur::class, inversedBy: "evenements")]
    #[ORM\JoinColumn(name: 'organisateur_id', referencedColumnName: 'Cin', onDelete: 'CASCADE')]
    private Utilisateur $organisateur_id;

    #[ORM\Column(type: "string", length: 255)]
    private string $nom_evenement;

    #[ORM\Column(type: "string", length: 255)]
    private string $date_evenement;

    #[ORM\Column(type: "string", length: 255)]
    private string $lieu_evenement;

    public function getId_evenement()
    {
        return $this->id_evenement;
    }

    public function setId_evenement($value)
    {
        $this->id_evenement = $value;
    }

    public function getCategorie_id()
    {
        return $this->categorie_id;
    }

    public function setCategorie_id($value)
    {
        $this->categorie_id = $value;
    }

    public function getOrganisateur_id()
    {
        return $this->organisateur_id;
    }

    public function setOrganisateur_id($value)
    {
        $this->organisateur_id = $value;
    }

    public function getNom_evenement()
    {
        return $this->nom_evenement;
    }

    public function setNom_evenement($value)
    {
        $this->nom_evenement = $value;
    }

    public function getDate_evenement()
    {
        return $this->date_evenement;
    }

    public function setDate_evenement($value)
    {
        $this->date_evenement = $value;
    }

    public function getLieu_evenement()
    {
        return $this->lieu_evenement;
    }

    public function setLieu_evenement($value)
    {
        $this->lieu_evenement = $value;
    }
}
