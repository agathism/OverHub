<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('username', TextType::class, [
                'attr' => [
                    'class' => 'bg-zinc-100 text-black rounded-md px-4 py-2',
                    'placeholder' => 'Change your username'
                ],
                'label_attr' => ['class' => 'form-label']
            ])
            ->add('confirm', SubmitType::class,[
                'attr' => [
                    'class' => 'bg-zinc-800 text-white rounded-md px-4 py-2 hover:bg-zinc-700',
                ],
                'label' => 'Update Profile'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
