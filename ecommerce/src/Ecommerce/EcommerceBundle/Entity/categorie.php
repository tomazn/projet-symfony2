<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\categorieRepository")
 */
class categorie
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
     * @ORM\Column(name="intitule", type="string", length=255)
     */
    private $intitule;

     /**
   * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\categorie",cascade={"persist"})
   * @ORM\JoinColumn(nullable=true)
   */
    private $parent;

    /**
     * @var bool
     *
     * @ORM\Column(name="enfant", type="boolean")
     */
    private $enfant;
    
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
     * Set intitule
     *
     * @param string $intitule
     *
     * @return categorie
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }

    /**
     * Set produit
     *
     * @param \Ecommerce\EcommerceBundle\Entity\produits $produit
     *
     * @return categorie
     */
    public function setProduit(\Ecommerce\EcommerceBundle\Entity\produits $produit)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Ecommerce\EcommerceBundle\Entity\produits
     */
    public function getProduit()
    {
        return $this->produit;
    }
    
    public function __toString() {
    return $this->intitule;
}

    /**
     * Set parent
     *
     * @param \Ecommerce\EcommerceBundle\Entity\categorie $parent
     *
     * @return categorie
     */
    public function setParent(\Ecommerce\EcommerceBundle\Entity\categorie $parent)
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * Get parent
     *
     * @return \Ecommerce\EcommerceBundle\Entity\categorie
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Set enfant
     *
     * @param boolean $enfant
     *
     * @return categorie
     */
    public function setEnfant($enfant)
    {
        $this->enfant = $enfant;

        return $this;
    }

    /**
     * Get enfant
     *
     * @return boolean
     */
    public function getEnfant()
    {
        return $this->enfant;
    }
}
