<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class RegisterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Email',
                'attr' => [
                    'id' => 'username',
                    'class' => 'w-full my-4 p-2 bg-ow-input rounded-md border border-gray-700 focus:border-ow-input hover:border-ow-input transition-all duration-200',
                ],
                'label_attr' => [
                    'class' => 'text-ow-white',
                ],
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Email(),
                ],
            ])
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'mapped' => false,
                'first_options'  => [
                    'label' => 'Password',
                    'attr' => [
                        'id' => 'password',
                        'class' => 'w-full my-4 p-2 bg-ow-input rounded-md border border-ow-input focus:border-ow-input hover:border-ow-input transition-all duration-200',
                    ],
                    'label_attr' => [
                        'class' => 'text-ow-white',
                    ],
                ],
                'second_options' => [
                    'label' => 'Confirm your password',
                    'attr' => [
                        'class' => 'w-full my-4 p-2 bg-ow-input rounded-md border border-ow-input focus:border-ow-input hover:border-ow-input transition-all duration-200',
                    ],
                    'label_attr' => [
                        'class' => 'text-ow-white',
                    ],
                ],
                'invalid_message' => 'The passwords should be the same',
                'constraints' => [
                    new Assert\NotBlank(),
                    new Assert\Length(['min' => 3]),
                ],
            ]);
    }

     public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
