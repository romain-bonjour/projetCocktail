<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
            'label' => false,
            'required' => true,
            'attr' => [
                /*'value' => '', Je garde ca pour le cocktail type new  à créer
                'placeholder' => 'Le nom du cocktail',*/
                'class' => 'form'],
            ])
            ->add('description', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'class' => 'form'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
