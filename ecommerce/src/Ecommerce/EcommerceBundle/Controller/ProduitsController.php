<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{
    public function indexAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $repoProduits = $manager->getRepository("EcommerceEcommerceBundle:produits");
        $cat = null;
        
        if(is_null($categorie) || $categorie == 0){
            $produits = $repoProduits->findAll();
        }else{
            $cat = $manager->getRepository("EcommerceEcommerceBundle:categorie")->find($categorie);
            if($cat->getEnfant()){
                $produits = $repoProduits->findProduitsEnfant($categorie);
            }else{
                $produits = $repoProduits->findBy(array('categorie'=>$categorie));
            }
        }
        
        
        return $this->render('EcommerceEcommerceBundle:Produits:produits.html.twig', array("produits"=>$produits,"categorie"=>$cat));
    }
}
