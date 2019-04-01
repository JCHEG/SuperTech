<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProduitRepository")
 */
class Produit
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(name="prixHT", type="decimal", precision=7, scale=2)
     */
    private $prixHT;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enSolde;

    /**
     * @ORM\Column(type="boolean")
     */
    private $enAvant;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie", inversedBy="produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeBarre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $codeFournisseur;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $taille;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $conditionnement;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=2)
     */
    private $prixAchat;

    /**
     * @ORM\Column(type="decimal", precision=4, scale=2)
     */
    private $tva;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enVente;

    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="produit", cascade={"persist","remove", "refresh"})
     */
    private $images;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->images = new \Doctrine\Common\Collections\ArrayCollection();
        //$this->categorie = new Categorie();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Add images.
     *
     * @param Image $image
     *
     * @return Produit
     */
    public function addImages(Image $image)
    {
        $this->images[] = $image;
        $image->setProduit($this);

        return $this;
    }

    /**
     * Remove images.
     *
     * @param Image $image
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeImages(Image $image)
    {
        return $this->images->removeElement($image);
    }

    /**
     * Get images.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPrixHT(): ?int
    {
        return $this->prixHT;
    }

    public function setPrixHT(int $prixHT): self
    {
        $this->prixHT = $prixHT;

        return $this;
    }

    public function getPrixTTC(): ?int
    {
        return $this->prixHT * (1 + $this->tva);
    }

    public function getEnSolde(): ?bool
    {
        return $this->enSolde;
    }

    public function setEnSolde(bool $enSolde): self
    {
        $this->enSolde = $enSolde;

        return $this;
    }

    public function getEnAvant(): ?bool
    {
        return $this->enAvant;
    }

    public function setEnAvant(bool $enAvant): self
    {
        $this->enAvant = $enAvant;

        return $this;
    }

    public function getCategorie(): Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getCodeBarre(): ?string
    {
        return $this->codeBarre;
    }

    public function setCodeBarre(string $codeBarre): self
    {
        $this->codeBarre = $codeBarre;

        return $this;
    }

    public function getCodeFournisseur(): ?string
    {
        return $this->codeFournisseur;
    }

    public function setCodeFournisseur(string $codeFournisseur): self
    {
        $this->codeFournisseur = $codeFournisseur;

        return $this;
    }

    public function getTaille(): ?string
    {
        return $this->taille;
    }

    public function setTaille(string $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getConditionnement(): ?string
    {
        return $this->conditionnement;
    }

    public function setConditionnement(string $conditionnement): self
    {
        $this->conditionnement = $conditionnement;

        return $this;
    }

    public function getPrixAchat(): ?string
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(int $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getTva()
    {
        return $this->tva;
    }

    public function setTva($tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getEnVente(): ?bool
    {
        return $this->enVente;
    }

    public function setEnVente(?bool $enVente): self
    {
        $this->enVente = $enVente;

        return $this;
    }

    /**
     * @return nom
     */
    public function __toString(): string
    {
        return $this->libelle;
    }
}
