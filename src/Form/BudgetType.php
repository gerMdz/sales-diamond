<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Cliente;
use App\Entity\Product;
use App\Repository\ProductRepository;
use AppBundle\Entity\RepLog;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;

class BudgetType extends AbstractType
{
    private ProductRepository $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $productosSales = $this->productRepository->getProductsForSales();
        $choices = array();
        foreach ($productosSales as $producto) {
            $choices[$producto->getTitle()] = $producto->getId()->toRfc4122();
        }
        $builder
            ->add('cliente', EntityType::class, [
                'class' => Cliente::class,
                'attr' => [
                    'class' => 'selection2 form-control'
                ]
            ])
            ->add('productos', ChoiceType::class, [
                'choices' => $choices,
                'placeholder' => '¿Que producto desea ingresar?',
                'label' => 'Productos',
                'mapped' => false,
                'attr' => [
                    'class' => 'selection2 form-control col-sm-3',
                ]

            ])
            ->add('aclaraciones', TextareaType::class, [
                'attr' => [
                    'cols' => 50,
                    'rows' => 10
                ]
            ])
            ->add('itemBudgets', CollectionType::class, [
                'prototype' => new ItemBudgetType(),
                'allow_add' => true,
                'allow_delete' => true,
            ])
            ->add('cliente_confirma')
            ->add('total');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Budget::class,
        ]);
    }
}
