<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity]
class Demande
{

    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $Demande_id;

    #[ORM\Column(type: "integer")]
    private int $Utilisateur_id;

    #[ORM\Column(type: "text")]
    private string $contenu;

    #[ORM\Column(type: "date")]
    private \DateTimeInterface $date_demande;

    #[ORM\Column(type: "string", length: 255)]
    private string $statut;

    public function getDemande_id()
    {
        return $this->Demande_id;
    }

    public function setDemande_id($value)
    {
        $this->Demande_id = $value;
    }

    public function getUtilisateur_id()
    {
        return $this->Utilisateur_id;
    }

    public function setUtilisateur_id($value)
    {
        $this->Utilisateur_id = $value;
    }

    public function getContenu()
    {
        return $this->contenu;
    }

    public function setContenu($value)
    {
        $this->contenu = $value;
    }

    public function getDate_demande()
    {
        return $this->date_demande;
    }

    public function setDate_demande($value)
    {
        $this->date_demande = $value;
    }

    public function getStatut()
    {
        return $this->statut;
    }

    public function setStatut($value)
    {
        $this->statut = $value;
    }
}
