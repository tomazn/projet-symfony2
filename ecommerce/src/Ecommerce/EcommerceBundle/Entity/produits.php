<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * produits
 *
 * @ORM\Table(name="produits")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\produitsRepository")
 */
class produits
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prix", type="decimal", precision=10, scale=2)
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=2048)
     */
    private $description;

    /**
     * @var bool
     *
     * @ORM\Column(name="archive", type="boolean")
     */
    private $archive;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;
    
    /**
     * @ORM\OneToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\image",cascade={"persist","remove"})
     * @ORM\JoinColumn(nullable=false,onDelete="CASCADE")
     */
    private $image;

     /**
    * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\categorie")
    * @ORM\JoinColumn(nullable=false)
    */
    private $categorie;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return produits
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prix
     *
     * @param string $prix
     *
     * @return produits
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return string
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return produits
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set archive
     *
     * @param boolean $archive
     *
     * @return produits
     */
    public function setArchive($archive)
    {
        $this->archive = $archive;

        return $this;
    }

    /**
     * Get archive
     *
     * @return bool
     */
    public function getArchive()
    {
        return $this->archive;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     *
     * @return produits
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->categorie = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add categorie
     *
     * @param \Ecommerce\EcommerceBundle\Entity\categorie $categorie
     *
     * @return produits
     */
    public function addCategorie(\Ecommerce\EcommerceBundle\Entity\categorie $categorie)
    {
        $this->categorie[] = $categorie;

        return $this;
    }

    /**
     * Remove categorie
     *
     * @param \Ecommerce\EcommerceBundle\Entity\categorie $categorie
     */
    public function removeCategorie(\Ecommerce\EcommerceBundle\Entity\categorie $categorie)
    {
        $this->categorie->removeElement($categorie);
    }

    /**
     * Get categorie
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCategorie()
    {
        return $this->categorie;
    }

    /**
     * Set categorie
     *
     * @param \Ecommerce\EcommerceBundle\Entity\categorie $categorie
     *
     * @return produits
     */
    public function setCategorie(\Ecommerce\EcommerceBundle\Entity\categorie $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Set image
     *
     * @param \Ecommerce\EcommerceBundle\Entity\image $image
     *
     * @return produits
     */
    public function setImage(\Ecommerce\EcommerceBundle\Entity\image $image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Ecommerce\EcommerceBundle\Entity\image
     */
    public function getImage()
    {
        return $this->image;
    }
}
