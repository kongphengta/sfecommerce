<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;

class RegisterUserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Votre adresse e-mail',
                'attr' => ['placeholder' => "Indiquez votre adresse e-mail"]
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'constraints' => [new Length([
                    'min' => 8,
                    'max' => 20
                    ])],
                'first_options'  => [
                    'label' => 'Votre mot de passe ',
                    'attr' => ['placeholder' => "Choissisez votre mot de passe"], 
                    'hash_property_path' => 'password'],
                'second_options' => [
                    'label' => 'Confirmez votre mot de passe',
                    'attr' => ['placeholder' => "Confirmez votre mot de passe"] 
                ],
                // n'essaie pas de faire le lien avec entité User 
                'mapped' => false,
            ])
            ->add('firstname', TextType::class, [
                'label' => 'Votre prénom',
                'constraints' => [new Length([
                    'min' => 4,
                    'max' => 20
                    ])],
                'attr' => ['placeholder' => "Indiquez votre prénom"]
            ])
            ->add('lastname', TextType::class, [
                'label' => 'Votre nom',
                'constraints' => [new Length([
                    'min' => 4,
                    'max' => 20
                    ])],
                'attr' => ['placeholder' => "Indiquez votre nom"]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'constraints' => [
                new UniqueEntity([
                    'entityClass' => User::class,
                    'fields' => 'email'
                ])
                ],
            'data_class' => User::class,
        ]);
    }
}
