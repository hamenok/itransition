<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;

class EditProfileFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class)
            ->add('firstname', null, [
                'label'=>'FIRST NAME',
                'label_attr'=>['class'=>'form-label']
            ])
            ->add('lastname')
            ->add('phone', TelType::class, [
                'required' => false
            ])
            ->add('avatar', FileType::class, [ 
                'data_class' => null,
                'required' => false
                ])
            ->add('avatar_', HiddenType::class, [ 
                'label' =>' ',
                'data_class' => null,
                'required' => false
                ])
            ->add('save', SubmitType::class, [
                'label' => 'SAVE PROFILE'
            ])
            ->add('delete', SubmitType::class, [
                'label' => 'REMOVE PHOTO'
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
