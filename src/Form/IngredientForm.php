<?php

namespace App\Form;

use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints as Assert;


class IngredientForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,[
                'label'=>'Nom',
                'label_attr'=>['class'=>'control-label mt-4'],
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Entrez le nom de l\'ingredient',
                    'minLength'=>2,
                    'maxLength'=>50
                ],
                'constraints'=>[
                    new NotBlank([]),
                    new Assert\Length(['min'=>2,'max'=>2]),
                ]
            ])
            ->add('price',MoneyType::class,[
                'label'=>'Prix',
                'label_attr'=>['class'=>'control-label mt-4'],
                'attr'=>[
                    'class'=>'form-control',
                    'placeholder'=>'Entrez le prix',
                ],
                'constraints'=> [
                    new Assert\Positive(),
                    new Assert\LessThan(200)
                ]
            ])
            ->add('submit',SubmitType::class,[
                'attr' => [
                    'class' => 'btn btn-primary mt-4',
                ],
                'label' => 'Créer mon ingrédient'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Ingredient::class,
        ]);
    }
}
