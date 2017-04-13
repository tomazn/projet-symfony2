<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function indexAction()
    {
        $manager = $this->getDoctrine()->getManager();
        
        $produits = $manager->getRepository("EcommerceEcommerceBundle:produits")->findAll();
        
        return $this->render('EcommerceEcommerceBundle:Produits:produits.html.twig', array("produits"=>$produits));
    }
}
