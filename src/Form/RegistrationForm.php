<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class RegistrationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('fullName',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control mb-4',
                        'minlength' => '2',
                        'maxlength' => '50',
                    ],
                    'label' => 'Nom / Prénom',
                    'label_attr'=>['class'=>'control-label'],
                    'constraints' => [
                        new Assert\NotBlank(message: 'Ce champ ne peut pas être vide.'),
                        new Assert\Length(min: 2, max: 50, minMessage: 'La longueur doit être supérieure à 2 mots',maxMessage: 'La longueur ne peut dépasser 50 mots')
                    ]
                ]
            )
            ->add('pseudo',TextType::class,[
                    'attr'=>[
                        'class'=>'form-control mb-4',
                        'minlength' => '2',
                        'maxlength' => '50',
                    ],
                    'required'=>false,
                    'label' => 'Pseudo (Facultative)',
                    'label_attr'=>['class'=>'control-label'],
                    'constraints' => [
                        new Assert\Length(min: 2, max: 50, minMessage: 'La longueur doit être supérieure à 2 mots',maxMessage: 'La longueur ne peut dépasser 50 mots')
                    ]
                ]
            )
            ->add('email',EmailType::class,[
                'attr' => [
                    'class' => 'form-control mb-4',
                    'minlength' => '2',
                    'maxlength' => '180',
                ],
                'label' => 'Adresse email',
                'label_attr' => ['class' => 'control-label'],
                'constraints' => [
                    new Assert\NotBlank(message: 'Ce champ ne peut pas être vide.'),
                    new Assert\Email(message: 'Adresse email "{{ value }}" invalide.'),
                    new Assert\Length(min: 2, max: 180, minMessage: 'La longueur doit être supérieure à 2 mots',maxMessage: 'La longueur ne peut dépasser 180 mots')
                ]
            ])
            ->add('plainPassword',RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options'  => [
                    'label' => 'Mot de passe',
                    'label_attr' => ['class' => 'control-label'],
                    'attr' => [
                        'class' => 'form-control mb-4',
                    ]
                ],
                'second_options' => [
                    'label' => 'Confirmer le mot de passe',
                    'label_attr' => ['class' => 'control-label'],
                    'attr' => [
                        'class' => 'form-control mb-4'
                    ]
                ],
                'invalid_message' => 'Les mots de passe ne correspondent pas',
                'constraints' => [
                    new Assert\NotBlank(message: 'Le mot de passe ne peut pas être vide.'),
                    new Assert\Length(min: 3, minMessage: 'Le mot de passe doit faire au moins 6 caractères.'),
                ],
            ])

            ->add('submit',SubmitType::class,[
                'label' => 'S\'inscrire',
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ]
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
