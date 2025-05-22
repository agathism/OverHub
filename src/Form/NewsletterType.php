<?php

namespace App\Form;

use App\Entity\Newsletter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'bg-ow-white border placeholder-ow-pink text-md rounded-lg placeholder-opacity-60 block w-full py-5',
                    'placeholder' => 'Your email adress'
                ]
            ])
            ->add('Subscribe', SubmitType::class, [
                'attr' => ['class' => 'bg-ow-pink hover:bg-ow-violet text-ow-white p-2 my-2 rounded-lg']
            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
            'csrf_protection' => false,
        ]);
    }
}
