<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CommandeRepository::class)
 */
class Commande
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $numero;

    /**
     * @ORM\Column(type="integer")
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="commandes")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity=Restaurant::class, inversedBy="commandes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $restaurant;

    /**
     * @ORM\OneToMany(targetEntity=LigneDeCommande::class, mappedBy="commande", orphanRemoval=true)
     */
    private $lignesDeCommandes;

    public function __construct()
    {
        $this->lignesDeCommandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?int
    {
        return $this->numero;
    }

    public function setNumero(int $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getClient(): ?User
    {
        return $this->client;
    }

    public function setClient(?User $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getRestaurant(): ?Restaurant
    {
        return $this->restaurant;
    }

    public function setRestaurant(?Restaurant $restaurant): self
    {
        $this->restaurant = $restaurant;

        return $this;
    }

    /**
     * @return Collection|LigneDeCommande[]
     */
    public function getLignesDeCommandes(): Collection
    {
        return $this->lignesDeCommandes;
    }

    public function addLignesDeCommande(LigneDeCommande $lignesDeCommande): self
    {
        if (!$this->lignesDeCommandes->contains($lignesDeCommande)) {
            $this->lignesDeCommandes[] = $lignesDeCommande;
            $lignesDeCommande->setCommande($this);
        }

        return $this;
    }

    public function removeLignesDeCommande(LigneDeCommande $lignesDeCommande): self
    {
        if ($this->lignesDeCommandes->removeElement($lignesDeCommande)) {
            // set the owning side to null (unless already changed)
            if ($lignesDeCommande->getCommande() === $this) {
                $lignesDeCommande->setCommande(null);
            }
        }

        return $this;
    }
}
