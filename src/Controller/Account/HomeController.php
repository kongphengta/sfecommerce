<?php

namespace App\Controller\Account;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route('/compte', name: 'app_account')]
    public function index(): Response
    {
        return $this->render('account/index.html.twig');
    }
}
    // #[Route('/compte/modifier-mot-de-passe', name: 'app_account_modify_pwd')]
    // public function password(Request $request, UserPasswordHasherInterface $passwordHasher): Response
    // {
    //     $user = $this->getUser();
     
    //     $form = $this->createForm(PasswordUserType::class, $user, [
    //         'passwordHacher' => $passwordHasher
    //     ]);

    //     $form->handleRequest($request);

    //     if($form->isSubmitted() && $form->isValid())
    //     {
    //         $this->entityManager->flush();
    //         $this->addFlash(
    //             'success',
    //             "Votre mot de passe est correctement mise à jour"
    //         );
    //     }

    //     return $this->render('account/password.html.twig', [
    //         'modifyPwd' => $form->createView()
    //     ]);
    // }

    // #[Route('/compte/adresses', name: 'app_account_addresses')]
    // public function addresses(): Response
    // {
    //     return $this->render('account/addresses.html.twig');
    // }

    // #[Route('/compte/adresses/delete/{id}', name: 'app_account_addresses_delete')]
    // public function addressDelete($id, AddressRepository $addressRepository): Response
    // {
    //         $address = $addressRepository->findOneById($id);
    //         if(!$address OR $address->getUser() != $this->getUser()) {
    //             return $this->redirectToRoute('app_account_addresses');
    //         }
    //         $this->addFlash(
    //             'success',
    //             "Votre adresse est correctement supprimée."
    //         );
    //         $this->entityManager->remove($address);
    //         $this->entityManager->flush();

    //         return $this->redirectToRoute('app_account_addresses');
    // }

    // #[Route('/compte/adresse/ajouter/{id}', name: 'app_account_address_form', defaults : ['id' => null])]
    // public function addressForm(Request $request, $id, AddressRepository $addressRepository): Response
    // {
    //     if($id)
    //     {
    //         $address = $addressRepository->findOneById($id);
    //         if(!$address OR $address->getUser() != $this->getUser()) {
    //             return $this->redirectToRoute('app_account_addresses');
    //         }
    //     } else 
    //     {
    //         $address = new Address;
    //         $address->setUser($this->getUser());
    //     }


    //     $form = $this->createForm(AddressUserType::class, $address);
    //     $form->handleRequest($request);
    //     if ($form->isSubmitted() && $form->isValid()) 
    //     {
    //         $this->entityManager->persist($address);
    //         $this->entityManager->flush();

    //         $this->addFlash(
    //             'success',
    //             "Votre adresse est correctement sauvegardée."
    //         );
    //         return $this->redirectToRoute('app_account_addresses');
    //     }

    //     return $this->render('account/addressForm.html.twig', [
    //         'addressForm' => $form
    //     ]);
    // }


