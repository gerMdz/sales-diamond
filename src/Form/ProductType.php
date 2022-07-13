<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Range;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Título',
                'attr' => [
                    'form-control'
                ]
            ])
            ->add('description',TextType::class, [
        'label' => 'Descripción',
                'attr' => [
                    'form-control'
                ]
    ])
            ->add('isAvailable', CheckboxType::class,[
                'label' => '¿Disponible?',
                'attr' => [
                    'form-control'
                ]
            ])
            ->add('identifier', TextType::class, [
                'label' => 'Identificador',
                'help' => 'Debe se único',
                'attr' => [
                    'form-control'
                ]
            ])
            ->add('isForSale', CheckboxType::class, [
                'label' => '¿Disponible para la venta?',
                'required' => false,
                'attr' => [
                    'form-control'
                ]
            ])
            ->add('valueForSale', NumberType::class, [
                'label' => 'Valor de venta',
                'html5' => true,
                'required' => false,
                'attr' => [
                    'class' => 'form-control',
                    'min' => 1,
                ]
            ])
            ->add('unidadVenta', TextType::class, [
                'label' => 'Unidad de venta',
                'help' => 'x unidad, x metro, x kit'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
