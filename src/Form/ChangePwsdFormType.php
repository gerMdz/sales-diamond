<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ChangePwsdFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add("justpassword", PasswordType::class, [
                "label" =>"Contraseña anterior",
                "required" => true,
                "mapped" => false,
                "constraints" => [
                    new NotBlank(["message" =>"No debe estar vacío"]),
                    new UserPassword(["message" => "Contraseña incorrecta"])
                ]
            ])
            ->add("newpassword", RepeatedType::class, [
                "mapped" => false,
                'invalid_message' => "Las contraseñas no coinciden",
                "type" => PasswordType::class,
                "constraints" => [
                    new NotBlank(["message" => "No debe estar en blanco"])
                ],
                "first_options"  => ['label' => "Escriba su nueva contraseña"],
                "second_options"  => ['label' => "Repita la anterior contraseña"]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {


        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
