<?php

namespace App\Form;

use App\Entity\Items;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ItemsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nameItem', TextType::class, [
                'required' => true
            ])
            ->add('tagItem', CollectionType::class, [
                
                'allow_delete'=>true,
                'allow_add' => true,
                'required' => false
            ])
            ->add('imageItems', FileType::class, [ 
                'data_class' => null,
                'required' => false
                ])
            ->add('save', SubmitType::class, [
                'label' => 'ADD ITEM'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Items::class,
        ]);
    }
}
