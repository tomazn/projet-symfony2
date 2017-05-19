<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{
    public function indexAction($categorie)
    {
        $manager = $this->getDoctrine()->getManager();
        $cat = null;
        if(is_null($categorie) == false || $categorie != 0){
            $cat = $manager->getRepository("EcommerceEcommerceBundle:categorie")->find($categorie);
        }
        return $this->render('EcommerceEcommerceBundle:Produits:produits.html.twig', array("categorie"=>$cat));
    }
    
    public function getProduitsAction(Request $request)
    {
        $categorie = $request->query->get('categorie');
                
        $manager = $this->getDoctrine()->getManager();
        $repoProduits = $manager->getRepository("EcommerceEcommerceBundle:produits");
        
        if(is_null($categorie) || $categorie == 0){
            $produits = $repoProduits->findAll();
        }else{
            $cat = $manager->getRepository("EcommerceEcommerceBundle:categorie")->find($categorie);
            if($cat->getEnfant()){
                $produits = $repoProduits->findProduitsEnfant($categorie);
            }else{
                $produits = $repoProduits->findProduits($categorie);
            }
        }
       
       $serializer = $this->get('serializer');
       $response = $serializer->serialize($produits,'json');

       return new Response($response);
    }
}
