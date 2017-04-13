<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Form\produitsType;
use Ecommerce\EcommerceBundle\Form\produitsEditType;
use Symfony\Component\HttpFoundation\Request;

class AdminController extends Controller
{
    public function indexAction(Request $request)
    {   
        $produits = new produits();

         $form = $this->createForm(produitsType::class, $produits);
         
         if($form->handleRequest($request)->isValid()){
             $manager = $this->getDoctrine()->getManager();
             $manager->persist($produits);
             $manager->flush();
         }
        
         $manager = $this->getDoctrine()->getManager();
         $ListeProduits = $manager->getRepository("EcommerceEcommerceBundle:produits")->findAll();
         
        return $this->render('EcommerceEcommerceBundle:Admin:admin.html.twig', array("form"=>$form->createView(), "produits"=>$ListeProduits));
    }
    
    public function formEditAction(Request $request)
    {  
        $id = $request->request->get('id'); 
        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);        
        $form = $this->createForm(produitsEditType::class, $produit);
        
         if ($request->getMethod() == 'POST') {
         if($form->handleRequest($request)->isValid()){
             $manager->flush();
         }
        }
            return $this->render('EcommerceEcommerceBundle:Admin:formEdit.html.twig', array("formEdit"=>$form->createView()));
         
    }
    
    public function formDeleteAction(Request $request)
    {
        $id = $request->request->get('id'); 
        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);
        if ($request->getMethod() == 'POST') {
            $manager->remove($produit);
            $manager->flush();
        }
        
        return $this->render('EcommerceEcommerceBundle:Admin:formDelete.html.twig');
    }
}
