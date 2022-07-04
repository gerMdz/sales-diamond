<?php

namespace App\Form;

use App\Entity\ItemBudget;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemBudgetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('costo')
            ->add('unidad_costo')
            ->add('cantidad_costo')
            ->add('excendentes')
            ->add('excedentes_costo')
            ->add('observacion')
            ->add('budget')
            ->add('producto')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ItemBudget::class,
        ]);
    }
}
