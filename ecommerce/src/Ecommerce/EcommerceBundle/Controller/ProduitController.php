<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function indexAction($id)
    {
        $manager = $this->getDoctrine()->getManager();
        
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);
        
        return $this->render('EcommerceEcommerceBundle:Produit:produit.html.twig', array("produit"=>$produit));
    }
}
