<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('firstname', TextType::class, [
            'attr' => [
                'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-ow-pink',
                'placeholder' => 'Your firstname'
            ],
            'label_attr' => ['class' => 'block text-ow-white mb-3'],
            'row_attr' => ['class' => 'mb-4']
        ])
        ->add('lastname', TextType::class, [
            'attr' => [
                'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-ow-pink',
                'placeholder' => 'Your lastname'
            ],
            'label_attr' => ['class' => 'block text-ow-white mb-3'],
            'row_attr' => ['class' => 'mb-4']
        ])
        ->add('email', EmailType::class, [
            'attr' => [
                'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-ow-pink',
                'placeholder' => 'example@domain.com'
            ],
            'label_attr' => ['class' => 'block text-ow-white mb-3'],
            'row_attr' => ['class' => 'mb-4']
        ])
        ->add('subject', ChoiceType::class, [
            'choices' => [
                'Informational Request' => 'information',
                'Suggestion' => 'suggestion',
                'Technical support' => 'support',
                'Partnership' => 'partnership'
            ],
            'attr' => [
                'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-ow-pink'
            ],
            'label_attr' => ['class' => 'block text-ow-white mb-3'],
            'row_attr' => ['class' => 'mb-4'],
            'placeholder' => 'Choose a subject'
        ])
        ->add('message', TextareaType::class, [
            'attr' => [
                'class' => 'w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:border-ow-pink',
                'rows' => 5,
                'placeholder' => 'Your message'
            ],
            'label_attr' => ['class' => 'block text-ow-white mb-3'],
        'row_attr' => ['class' => 'mb-4']
        ])
        ->add('Subscribe', SubmitType::class, [
            'attr' => ['class' => 'px-6 py-2 bg-ow-pink text-white rounded-lg hover:bg-ow-white hover:text-ow-pink focus:outline-none transition duration-300 cursor-pointer'],
            'label' => 'Send'
        ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
            'csrf_protection' => false,
        ]);
    }
}
