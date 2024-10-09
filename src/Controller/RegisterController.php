<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegisterUserType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class RegisterController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = new User();

        $form = $this->createForm(RegisterUserType::class, $user);
        // écoute la variable $request
        $form->handleRequest($request); 
        // Si le formulaire est soumis alors :
        if($form->isSubmitted() && $form->isValid())
        {
 
             // Tu enregistre les datas en base de données
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                'success',
                "Votre compte est correctement créé, veuillez vous connecter."
            );
            
            return $this->redirectToRoute('app_login');
        }

           
            // Tu envoies le message de confirmation du compte a été bien créé


        return $this->render('register/index.html.twig', [
            'registerForm' => $form->createView()
        ]);
    }
}
