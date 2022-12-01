<?php

namespace App\Entity;

use App\Repository\FormateurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormateurRepository::class)]
class Formateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom_formateur = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom_formateur = null;

    #[ORM\Column(length: 150)]
    private ?string $email_formateur = null;

    #[ORM\OneToMany(mappedBy: 'formateur', targetEntity: Session::class)]
    private Collection $sessions;

    public function __construct()
    {
        $this->sessions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomFormateur(): ?string
    {
        return $this->nom_formateur;
    }

    public function setNomFormateur(string $nom_formateur): self
    {
        $this->nom_formateur = $nom_formateur;

        return $this;
    }

    public function getPrenomFormateur(): ?string
    {
        return $this->prenom_formateur;
    }

    public function setPrenomFormateur(string $prenom_formateur): self
    {
        $this->prenom_formateur = $prenom_formateur;

        return $this;
    }

    public function getEmailFormateur(): ?string
    {
        return $this->email_formateur;
    }

    public function setEmailFormateur(string $email_formateur): self
    {
        $this->email_formateur = $email_formateur;

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
            $session->setFormateur($this);
        }

        return $this;
    }

    public function removeSession(Session $session): self
    {
        if ($this->sessions->removeElement($session)) {
            // set the owning side to null (unless already changed)
            if ($session->getFormateur() === $this) {
                $session->setFormateur(null);
            }
        }

        return $this;
    }
}
