<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CocktailNewType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'value' => '',
                    'placeholder' => 'Le nom du cocktail',
                    'class' => 'form'],
            ])
            ->add('description', TextType::class, [
                'label' => false,
                'required' => true,
                'attr' => [
                    'value' => '',
                    'placeholder' => 'La description du cocktail',
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
