<?php

namespace Ecommerce\EcommerceBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * panier
 *
 * @ORM\Table(name="panier")
 * @ORM\Entity(repositoryClass="Ecommerce\EcommerceBundle\Repository\panierRepository")
 */
class panier
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
     * @ORM\Column(name="prixTotal", type="decimal", precision=10, scale=0)
     */
    private $prixTotal = 0;

    /**
     * @var int
     *
     * @ORM\Column(name="nombreTotal", type="integer")
     */
    private $nombreTotal = 0;


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
     * Set prixTotal
     *
     * @param string $prixTotal
     *
     * @return panier
     */
    public function setPrixTotal($prixTotal)
    {
        $this->prixTotal = $prixTotal;

        return $this;
    }

    /**
     * Get prixTotal
     *
     * @return string
     */
    public function getPrixTotal()
    {
        return $this->prixTotal;
    }

    /**
     * Set nombreTotal
     *
     * @param integer $nombreTotal
     *
     * @return panier
     */
    public function setNombreTotal($nombreTotal)
    {
        $this->nombreTotal = $nombreTotal;

        return $this;
    }

    /**
     * Get nombreTotal
     *
     * @return int
     */
    public function getNombreTotal()
    {
        return $this->nombreTotal;
    }
}

