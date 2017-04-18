<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\produits;
use Ecommerce\EcommerceBundle\Entity\categorie;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Form\produitsType;
use Ecommerce\EcommerceBundle\Form\produitsEditType;
use Ecommerce\EcommerceBundle\Form\categorieType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Response;


class AdminController extends Controller
{
    public function indexAction(Request $request)
    {   
        return $this->render('EcommerceEcommerceBundle:Admin:admin.html.twig');
    }
    
    public function ProduitAddFormAction(Request $request)
    {
        $produits = new produits();

         $form = $this->createForm(produitsType::class, $produits, array(
            'action' => $this->generateUrl('ecommerce_ecommerce_admin_ProduitAddForm'),
            'method' => 'POST',
        ));
         
         $form->handleRequest($request);
         
         if($form->isSubmitted()){
            if($form->isValid()){
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($produits);
                $manager->flush();

                  return $this->redirect($this->generateUrl(
                    'ecommerce_ecommerce_produit',
                    array('id' => $produits->getId())
                ));
            }
         }
         return $this->render('EcommerceEcommerceBundle:Admin:ProduitAddForm.html.twig', array("form"=>$form->createView()));
         
    }
    
     public function ProduitEditFormAction(Request $request)
    {  
        $manager = $this->getDoctrine()->getManager();
        $ListeProduits = $manager->getRepository("EcommerceEcommerceBundle:produits")->findAll();
        
        return $this->render('EcommerceEcommerceBundle:Admin:ProduitEditForm.html.twig', array("produits"=>$ListeProduits));
         
    }
    
        
    public function ProduitEditFormModalAction(Request $request)
    {  
        $id = $request->request->get('id');
        if (null === $id) {
      throw new NotFoundHttpException("L'id n'existe pas.");
    }

        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id); 
        
        if (null === $produit) {
      throw new NotFoundHttpException("Le produit d'id ".$id." n'existe pas.");
    }
        
        $form = $this->createForm(produitsEditType::class,$produit);
        
         $form->handleRequest($request);

        if ($form->isSubmitted()) {
            if($form->isValid()){
            $manager->flush();
            return $this->redirect($this->generateUrl('ecommerce_ecommerce_produit',array('id'=>$id)));
            }
        }
            return $this->render('EcommerceEcommerceBundle:Admin:ProduitEditFormModal.html.twig', array("formEdit"=>$form->createView()));
         
    }
    
    public function ProduitdeleteFormAction(Request $request)
    {
        $id = $request->request->get('id'); 
        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);
        if ($request->getMethod() == 'POST') {
            $manager->remove($produit);
            $manager->flush();
        }
        
        return new Response("Catégorie ajouté.");
    }
    
    public function CategorieAddFormAction(Request $request){
        $categorie = new categorie();
        
         $form = $this->createForm(categorieType::class, $categorie);
         
          if($form->handleRequest($request)->isValid()){
             $manager = $this->getDoctrine()->getManager();
             $manager->persist($categorie);
             $manager->flush();
             
             return $this->redirect($this->generateUrl('ecommerce_ecommerce_admin'));
         }
         return $this->render('EcommerceEcommerceBundle:Admin:CategorieAddForm.html.twig', array("form"=>$form->createView()));
         
    }
}
