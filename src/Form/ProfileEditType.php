<?php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType; 
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\User;

class ProfileEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'label' => 'Change your email',
                'attr' => ['class' => 'w-full p-2 rounded border border-gray-300 focus:border-ow-blue transition'],
                'label_attr' => ['class' => 'block text-ow-white mb-3'],
                'row_attr' => ['class' => 'mb-4']
            ])
            ->add('password', PasswordType::class, [   
                'label' => 'Your new password',
                'attr' => ['class' => 'w-full p-2 rounded border border-gray-300 focus:border-ow-blue transition'],
                'label_attr' => ['class' => 'block text-ow-white mb-3'],
                'row_attr' => ['class' => 'mb-4']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_protection' => false,
        ]);
    }
}
