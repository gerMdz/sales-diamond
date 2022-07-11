<?php

namespace App\Form;

use App\Entity\Budget;
use App\Entity\Cliente;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cliente', EntityType::class,[
                'class' => Cliente::class,
                'attr' => [
                    'class' => 'selection2 form-control'
                ]
            ]            )
            ->add('productos', EntityType::class, [
                'class' => Product::class,
                'label' => 'Productos',
                'multiple' => true,
                'expanded' => true,
                'mapped' => false

            ])
            ->add('aclaraciones', TextareaType::class, [
                'attr' => [
                    'cols' => 50,
                    'rows' => 10
                ]
            ])
            ->add('cliente_confirma')
            ->add('total')




        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Budget::class,
        ]);
    }
}
