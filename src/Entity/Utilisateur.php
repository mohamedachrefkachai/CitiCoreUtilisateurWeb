<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Entity\Feedback;
use App\Entity\Evenement;

#[ORM\Entity]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    private int $Cin;

    #[ORM\Column(type: "string", length: 50)]
    private string $Nom;

    #[ORM\Column(type: "string", length: 50)]
    private string $Prenom;

    #[ORM\Column(type: "string", length: 15)]
    private string $Num_Tel;

    #[ORM\Column(type: "string", length: 100)]
    private string $Email;

    #[ORM\Column(type: "string")]
    private string $Genre;

    #[ORM\Column(type: "string", length: 255)]
    private string $Photo_Utilisateur;

    #[ORM\Column(type: "string", length: 255)]
    private string $Mot_De_Passe;

    #[ORM\Column(type: "string")]
    private string $Role;

    #[ORM\Column(type: "string", length: 255)]
    private string $Token;

    #[ORM\Column(type: "integer")]
    private int $failed_attempts;

    #[ORM\Column(type: "datetime")]
    private \DateTimeInterface $ban_time;

    #[ORM\Column(type: "integer")]
    private int $login_failures;

    #[ORM\Column(type: "boolean")]
    private bool $is_banned;

    #[ORM\OneToMany(mappedBy: "organisateur_id", targetEntity: Evenement::class)]
    private Collection $evenements;

    #[ORM\OneToMany(mappedBy: "Cin_Participant", targetEntity: Feedback::class)]
    private Collection $feedbacksParticipant;

    #[ORM\OneToMany(mappedBy: "Cin_Organisateur", targetEntity: Feedback::class)]
    private Collection $feedbacksOrganisateur;

    public function __construct()
    {
        $this->evenements = new ArrayCollection();
        $this->feedbacksParticipant = new ArrayCollection();
        $this->feedbacksOrganisateur = new ArrayCollection();
    }

    // === Getters/Setters de base ===

    public function getCin(): int { return $this->Cin; }
    public function setCin(int $value): void { $this->Cin = $value; }

    public function getNom(): string { return $this->Nom; }
    public function setNom(string $value): void { $this->Nom = $value; }

    public function getPrenom(): string { return $this->Prenom; }
    public function setPrenom(string $value): void { $this->Prenom = $value; }

    public function getNum_Tel(): string { return $this->Num_Tel; }
    public function setNum_Tel(string $value): void { $this->Num_Tel = $value; }

    public function getEmail(): string { return $this->Email; }
    public function setEmail(string $value): void { $this->Email = $value; }

    public function getGenre(): string { return $this->Genre; }
    public function setGenre(string $value): void { $this->Genre = $value; }

    public function getPhoto_Utilisateur(): string { return $this->Photo_Utilisateur; }
    public function setPhoto_Utilisateur(string $value): void { $this->Photo_Utilisateur = $value; }

    public function getMot_De_Passe(): string { return $this->Mot_De_Passe; }
    public function setMot_De_Passe(string $value): void { $this->Mot_De_Passe = $value; }

    public function getRole(): string { return $this->Role; }
    public function setRole(string $value): void { $this->Role = $value; }

    public function getToken(): string { return $this->Token; }
    public function setToken(string $value): void { $this->Token = $value; }

    public function getFailed_attempts(): int { return $this->failed_attempts; }
    public function setFailed_attempts(int $value): void { $this->failed_attempts = $value; }

    public function getBan_time(): \DateTimeInterface { return $this->ban_time; }
    public function setBan_time(\DateTimeInterface $value): void { $this->ban_time = $value; }

    public function getLogin_failures(): int { return $this->login_failures; }
    public function setLogin_failures(int $value): void { $this->login_failures = $value; }

    public function getIs_banned(): bool { return $this->is_banned; }
    public function setIs_banned(bool $value): void { $this->is_banned = $value; }

    // === Relations ===

    public function getEvenements(): Collection { return $this->evenements; }

    public function addEvenement(Evenement $evenement): self
    {
        if (!$this->evenements->contains($evenement)) {
            $this->evenements[] = $evenement;
            $evenement->setOrganisateur_id($this);
        }
        return $this;
    }

    public function removeEvenement(Evenement $evenement): self
    {
        if ($this->evenements->removeElement($evenement)) {
            if ($evenement->getOrganisateur_id() === $this) {
                $evenement->setOrganisateur_id(null);
            }
        }
        return $this;
    }

    public function getFeedbacksParticipant(): Collection { return $this->feedbacksParticipant; }

    public function addFeedbackParticipant(Feedback $feedback): self
    {
        if (!$this->feedbacksParticipant->contains($feedback)) {
            $this->feedbacksParticipant[] = $feedback;
            $feedback->setCin_Participant($this);
        }
        return $this;
    }

    public function removeFeedbackParticipant(Feedback $feedback): self
    {
        if ($this->feedbacksParticipant->removeElement($feedback)) {
            if ($feedback->getCin_Participant() === $this) {
                $feedback->setCin_Participant(null);
            }
        }
        return $this;
    }

    public function getFeedbacksOrganisateur(): Collection { return $this->feedbacksOrganisateur; }

    public function addFeedbackOrganisateur(Feedback $feedback): self
    {
        if (!$this->feedbacksOrganisateur->contains($feedback)) {
            $this->feedbacksOrganisateur[] = $feedback;
            $feedback->setCin_Organisateur($this);
        }
        return $this;
    }

    public function removeFeedbackOrganisateur(Feedback $feedback): self
    {
        if ($this->feedbacksOrganisateur->removeElement($feedback)) {
            if ($feedback->getCin_Organisateur() === $this) {
                $feedback->setCin_Organisateur(null);
            }
        }
        return $this;
    }
}
