<?php

namespace App\Entity;

use App\Repository\EtudiantRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EtudiantRepository::class)]
class Etudiant
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_etudiant = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom_etudiant = null;

    #[ORM\Column(length: 150)]
    private ?string $email_etudiant = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone_etudiant = null;

    #[ORM\ManyToMany(targetEntity: Session::class, inversedBy: 'etudiants')]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEtudiant(): ?string
    {
        return $this->nom_etudiant;
    }

    public function setNomEtudiant(string $nom_etudiant): self
    {
        $this->nom_etudiant = $nom_etudiant;

        return $this;
    }

    public function getPrenomEtudiant(): ?string
    {
        return $this->prenom_etudiant;
    }

    public function setPrenomEtudiant(string $prenom_etudiant): self
    {
        $this->prenom_etudiant = $prenom_etudiant;

        return $this;
    }

    public function getEmailEtudiant(): ?string
    {
        return $this->email_etudiant;
    }

    public function setEmailEtudiant(string $email_etudiant): self
    {
        $this->email_etudiant = $email_etudiant;

        return $this;
    }

    public function getPhoneEtudiant(): ?string
    {
        return $this->phone_etudiant;
    }

    public function setPhoneEtudiant(?string $phone_etudiant): self
    {
        $this->phone_etudiant = $phone_etudiant;

        return $this;
    }

    /**
     * @return Collection<int, Session>
     */
    public function getSessions(): Collection
    {
        return $this->sessions;
    }

    public function addSession(Session $session): self
    {
        if (!$this->sessions->contains($session)) {
            $this->sessions->add($session);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        $this->sessions->removeElement($session);

        return $this;
    }
}
