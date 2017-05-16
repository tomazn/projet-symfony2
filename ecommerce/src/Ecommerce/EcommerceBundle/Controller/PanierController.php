<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Ecommerce\EcommerceBundle\Entity\produits;
use Ecommerce\EcommerceBundle\Entity\commande;
use Ecommerce\EcommerceBundle\Entity\panier;

class PanierController extends Controller
{              
    
public function indexAction(Request $request)
{
    $manager = $this->getDoctrine()->getManager();
    $session = $request->getSession();
    $listPanier = null;
    $panier = null;
    
    if(is_null($session->get('panier_id'))){
        
    }else{
        $panier = $manager->getRepository("EcommerceEcommerceBundle:panier")->find($session->get('panier_id'));
        $listPanier = $manager->getRepository('EcommerceEcommerceBundle:commande')->findByPanier($panier);
    }   
        
    return $this->render('EcommerceEcommerceBundle:Panier:index.html.twig', array('listPanier'=>$listPanier,'panier'=>$panier));
}
    
public function addPanierAction(Request $request)
    {
        
        $id = $request->request->get('id');
        $quantite = 1;
        
         if (null === $id) {
            throw new NotFoundHttpException("L'id n'existe pas.");
        }

        $manager = $this->getDoctrine()->getManager();
        $produit = $manager->getRepository("EcommerceEcommerceBundle:produits")->find($id);

        if (null === $produit) {
            throw new NotFoundHttpException("Le produit d'id " . $id . " n'existe pas.");
        }
        
        $session = $request->getSession();
        $commandeAll = null;
        
          if(is_null($session->get('panier_id'))){
                $panier = new panier();
            }else{
                $panier = $manager->getRepository("EcommerceEcommerceBundle:panier")->find($session->get('panier_id'));
                $commandeAll = $manager->getRepository("EcommerceEcommerceBundle:commande")->findByPanier($panier);
            }   
            
        /*
         * On cherche parmi les différentes ligne de commande celle qui correspond au panier (cf. ligne du dessus)
         * Puis pour chaque ligne on cherche si le produit est déjà ajouté dans le panier
         * S'il l'est pas on ajoute une nouvelle commande sinon on incremente la quantité
         */
        $Ispresent = false;
        if(sizeof($commandeAll) > 0 && $commandeAll != null){
            foreach($commandeAll as $commandeLigne)
            {
                if($commandeLigne->getProduit()->getId() == $id)
                {
                    $commandeLigne->setQuantite($commandeLigne->getQuantite() + 1);
                    //Update du prix total et de la quantité totale
                    $panier->setNombreTotal($panier->getNombreTotal() + $quantite);
                    $panier->setPrixTotal($panier->getPrixTotal() + ($produit->getPrix()*$quantite));
                    $Ispresent = true;
                }
            }
        }
        
        /*
         * Si le panier est vide ou que le produit n'est pas présent dans le panier,
         * alors on créé une nouvelle ligne de commande
         */
        if(!$Ispresent || $commandeAll == null || sizeof($commandeAll) <=0)
            {
                $commande = new commande();
                $commande->setPanier($panier);
                $commande->setProduit($produit);
                $commande->setQuantite($quantite);
                $manager->persist($commande);
                
                //Update du prix total et de la quantité totale
                $panier->setNombreTotal($panier->getNombreTotal() + $quantite);
                $panier->setPrixTotal($panier->getPrixTotal() + ($produit->getPrix()*$quantite));
            }
        
        if(is_null($session->get('panier_id'))){
            $manager->persist($panier);
        }
        
        $manager->flush();
        
        //on définit la variable de session pour panier
        $session->set('panier_id',$panier->getId());
        
        return $this->render('EcommerceEcommerceBundle:Panier:AjoutPanier.html.twig');
    }
    
    public function deleteLignePanierAction(Request $request)
    {
        $id = $request->request->get('id');
        
         if (null === $id) {
            throw new NotFoundHttpException("L'id n'existe pas.");
        }
        
        $manager = $this->getDoctrine()->getManager();
        $session = $request->getSession();
        $commande = $manager->getRepository("EcommerceEcommerceBundle:commande")->find($id);

        if (null === $commande) {
            throw new NotFoundHttpException("La ligne panier d'id " . $id . " n'existe pas.");
        }
        
        if(is_null($session->get('panier_id'))){
              throw  new NotFountHttpException('La panier n\'éxiste pas');
          }else{
              $panier = $manager->getRepository('EcommerceEcommerceBundle:panier')->find($session->get('panier_id'));
              //Update du prix total et de la quantité totale
              $panier->setNombreTotal($panier->getNombreTotal() - $commande->getQuantite());
              $panier->setPrixTotal($panier->getPrixTotal() - ($commande->getProduit()->getPrix()*$commande->getQuantite()));
              
           }
        
        if ($request->getMethod() == 'POST') {
            $manager->remove($commande);
            $manager->flush();
        }
        
        return $this->render('EcommerceEcommerceBundle:Panier:SupprimerPanier.html.twig');
    }
}
