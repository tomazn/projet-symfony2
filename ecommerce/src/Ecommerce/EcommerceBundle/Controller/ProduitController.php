<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Ecommerce\EcommerceBundle\Entity\produits;
use Ecommerce\EcommerceBundle\Entity\commande;
use Ecommerce\EcommerceBundle\Entity\panier;

class ProduitController extends Controller
{
    public function indexAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);
        
        return $this->render('EcommerceEcommerceBundle:Produit:produit.html.twig', array("produit"=>$produit));
    }                   
}
