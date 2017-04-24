<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EcommerceEcommerceBundle:Default:index.html.twig');
    }
    
    public function categorieViewAction($currentParent=null){
        
        $manager = $this->getDoctrine()->getManager();
        $repo = $manager->getRepository("EcommerceEcommerceBundle:categorie");
        $categories = $repo->findAll();
        
        if(is_null($currentParent)){
            $defaut = $manager->getRepository("EcommerceEcommerceBundle:categorie")->findByIntitule('Aucun');
            $currentParent = $defaut[0]->getId();
        }
        
        return $this->render('EcommerceEcommerceBundle:Default:categorie.html.twig', array(
            "categorie"=>$categories,
            "currentParent"=>$currentParent
          ));
    }
}
