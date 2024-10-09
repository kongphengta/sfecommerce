<?php

namespace App\Form;

use App\Entity\User;
use PhpParser\Node\VariadicPlaceholder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormError;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class PasswordUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('actualPassword', PasswordType::class, [
                'label' => 'Votre mot de passe actuel',
                'attr' => [
                    'placeholder' => 'Indiquez votre mot de passe actuel'
                ],
                 // n'essaie pas de faire le lien avec entité User 
                'mapped' => false,
                ])

            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [new Length([
                    'min' => 8,
                    'max' => 20
                    ])],
                'first_options'  => [
                    'label' => 'Votre nouveau mot de passe ',
                    'attr' => ['placeholder' => "Choissisez votre nouveau mot de passe"], 
                    'hash_property_path' => 'password'],
                'second_options' => [
                    'label' => 'Confirmez votre nouveau mot de passe',
                    'attr' => ['placeholder' => "Confirmez votre nouveau mot de passe"] 
                ],
                // n'essaie pas de faire le lien avec entité User 
                'mapped' => false,
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Mettre à jour mon mot de passe'
            ])

            ->addEventListener(FormEvents::SUBMIT, function(FormEvent $event) {
                $form = $event->getForm();
                $user = $form->getConfig()->getOptions()['data'];

                $passwordHasher = $form->getConfig()->getOptions()['passwordHacher'];
                
                // Récupérer le mot de passe saisi par l'utilisateur et le comparer en base de données
                $isValid = $passwordHasher->isPasswordValid(
                    $user,
                    $form->get('actualPassword')->getData()
                );

                // Si c'es != envoyer une erreur
                if(!$isValid)
                {
                    // ajouter une erreur à mon formulaire
                    $form->get('actualPassword')->addError(new FormError("Votre mot de passe n'est pas conforme. Veuillez vérifier votre saisie"));
                }

            })
            ;
            
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'passwordHacher' => null
        ]);
    }
}
