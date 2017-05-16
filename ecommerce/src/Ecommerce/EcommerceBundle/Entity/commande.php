<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * commande
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\commandeRepository")
 */
class commande
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
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */ 
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\produits")
     * @ORM\JoinColumn(nullable=false)
     */
    private $produit;
    
    /**
     * @ORM\ManyToOne(targetEntity="Ecommerce\EcommerceBundle\Entity\panier")
     * @ORM\JoinColumn(nullable=false)
     */
    private $panier;
    
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
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return commande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set produits
     *
     * @param \Ecommerce\EcommerceBundle\Entity\produits $produits
     *
     * @return commande
     */
    public function setProduits(\Ecommerce\EcommerceBundle\Entity\produits $produits)
    {
        $this->produits = $produits;

        return $this;
    }

    /**
     * Get produits
     *
     * @return \Ecommerce\EcommerceBundle\Entity\produits
     */
    public function getProduits()
    {
        return $this->produits;
    }

    /**
     * Set panier
     *
     * @param \Ecommerce\EcommerceBundle\Entity\panier $panier
     *
     * @return commande
     */
    public function setPanier(\Ecommerce\EcommerceBundle\Entity\panier $panier)
    {
        $this->panier = $panier;

        return $this;
    }

    /**
     * Get panier
     *
     * @return \Ecommerce\EcommerceBundle\Entity\panier
     */
    public function getPanier()
    {
        return $this->panier;
    }

    /**
     * Set produit
     *
     * @param \Ecommerce\EcommerceBundle\Entity\produits $produit
     *
     * @return commande
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
}
