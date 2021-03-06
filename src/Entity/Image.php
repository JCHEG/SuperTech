<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ImageRepository")
 */
class Image
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
    private $url;

    /**
     *@ORM\Column(type="string", length=255)
     */
    private $alt;

    /**
     * @ORM\ManyToOne(targetEntity="Produit", inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function setAlt(string $alt): self
    {
        $this->alt = $alt;

        return $this;
    }

    /**
     * Set produit.
     *
     * @param Produit $produit
     *
     * @return Image
     */
    public function setProduit(Produit $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit.
     *
     * @return Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }
}
