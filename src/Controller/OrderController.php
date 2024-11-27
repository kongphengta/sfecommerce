<?php

namespace App\Controller;

use App\Form\OrderType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class OrderController extends AbstractController
{
    /**
     * Première étape du tunnel d'achat
     * Choix de l'adresse de livraison et de transporteur
     */
    #[Route('/commande/livraison', name: 'app_order')]
    public function index(): Response
    {
        $addresses = $this->getUser()->getAddresses();
        if(count($addresses) == 0){
            return $this->redirectToRoute('app_account_address_form');
        }

        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $addresses,
            'action' => $this->generateUrl('app_order_summary')
        ]);

        return $this->render('order/index.html.twig', [
            'deliverForm' => $form->createView(),
        ]);
    }

       /**
     * Deuxième étape du tunnel d'achat
     * Récap de la commande de l'utilisateur
     * Insertion en base de données
     * Préparation du paiement vers Stripe
     */
    #[Route('/commande/recapitulatif', name: 'app_order_summary')]
    public function add(Request $request): Response
    {
        $form = $this->createForm(OrderType::class, null, [
            'addresses' => $this->getUser()->getAddresses(),

        ]);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            // stocker les informations en base de données.
        }
       
        return $this->render('order/summary.html.twig', [
            'choices' =>$form->getData()
        ]);
    }
}
